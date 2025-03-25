<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Budget;
use app\models\Categorie;
use app\models\Departement;
use app\models\Prevision;
use app\models\Type;
use flight\Engine;

class DepartementController
{
  /** @var Engine */
  protected Engine $app;

  /**
   * Constructor
   */
  public function __construct(Engine $app)
  {
    $this->app = $app;
  }

  /**
   * @param Departement $departement
   */
  private function normalizedCategorieData($departement)
  {
    /** @var Categorie[] $categories */
    $categories = $departement->categories;
    $types = Type::all();

    $result = [];
    foreach ($categories as $e) {
      $result[$e->id] = [
        'id' => $e->id,
        'designation' => $e->designation,
        'types' => []
      ];
    }

    $result_types = [];
    foreach ($types as $type) {
      if (empty($result[$type->id_categorie]))
        continue;

      $result_types[$type->id] = [
        'id' => $type->id,
        'designation' => $type->designation,
        'id_categorie' => $type->id_categorie,
        'previsions' => [
          'previsions1' => [],
          'previsions2' => [],
          'totalPrevision1' => 0,
          'totalPrevision2' => 0,
          'totalRealisation1' => 0,
          'totalRealisation2' => 0
        ]
      ];
    }

    $result_previsions = [];

    $totalPrevision1s = [];
    $totalPrevision2s = [];
    $totalRealisation1s = [];
    $totalRealisation2s = [];

    foreach (Prevision::all() as $prevision) {
      if (empty($result_types[$prevision->id_type]))
        continue;

      $result_previsions[$prevision->id] = [
        'id' => $prevision->id,
        'prevision' => $prevision->prevision,
        'realisation' => $prevision->realisation,
        'designation' => $prevision->designation,
        'date' => $prevision->date,
        'type' => $prevision->type,
        'id_type' => $prevision->id_type
      ];

      $totalPrevision1s[$prevision->id_type] = $totalPrevision1s[$prevision->id_type] ?? 0;
      $totalRealisation1s[$prevision->id_type] = $totalRealisation1s[$prevision->id_type] ?? 0;
      $totalPrevision2s[$prevision->id_type] = $totalPrevision2s[$prevision->id_type] ?? 0;
      $totalRealisation2s[$prevision->id_type] = $totalRealisation2s[$prevision->id_type] ?? 0;

      if ($prevision->type == 0) {
        $totalPrevision1s[$prevision->id_type] += $prevision->prevision;
        $totalRealisation1s[$prevision->id_type] += $prevision->realisation;
      } else {
        $totalPrevision2s[$prevision->id_type] += $prevision->prevision;
        $totalRealisation2s[$prevision->id_type] += $prevision->realisation;
      }
    }

    // Combine
    foreach ($result_previsions as $v) {
      $type = $v['type'];
      if ($type == 0)
        $result_types[$v['id_type']]['previsions']['previsions1'][] = $v;
      else
        $result_types[$v['id_type']]['previsions']['previsions2'][] = $v;
    }

    foreach ($result_types as $v) {
      $v['previsions']['totalPrevision1'] = $totalPrevision1s[$v['id']] ?? 0;
      $v['previsions']['totalPrevision2'] = $totalPrevision2s[$v['id']] ?? 0;
      $v['previsions']['totalRealisation1'] = $totalRealisation1s[$v['id']] ?? 0;
      $v['previsions']['totalRealisation2'] = $totalRealisation2s[$v['id']] ?? 0;

      $result[$v['id_categorie']]['types'][] = $v;
    }

    return $result;
  }

  public function show($id)
  {
    $departement = Departement::find($id);

    if (!$departement) {
      sezzion()->tempset('error', 'Departement not found');
      $this->app->redirect('/');
      return;
    }

    if (auth()->get()->is_super_admin != 1 && auth()->get()->id_departement != $id) {
      sezzion()->tempset('error', 'Vous manquez d\'autorisation');
      $this->app->redirect('/');
      return;
    }

    $departementModels = [$departement];

    $budget = Budget::getCurrent($id);
    $budgetModel = $budget;

    $hasBudget = $budget !== 'Pas de Budget';

    $departements = IndexController::mapDepartementModels($departementModels);

    $categories = $this->normalizedCategorieData($departement);

    $budgetFinal = "Pas de Budget Initial";

    if ($hasBudget) {
      $budgetFinal = $budget->solde;

      foreach ($categories as $categorie)
        foreach ($categorie['types'] as $type) {
          $budgetFinal -= $type['previsions']['totalPrevision1'];
          $budgetFinal += $type['previsions']['totalPrevision2'];
        }

      $budget = $budget->solde . " Ar";
      $budgetFinal = $budgetFinal . " Ar";
    }

    $closedBudget = (bool) $budgetModel->locked;

    piewpiew('pages.departement.departement', compact('departement', 'budget', 'departements', 'hasBudget', 'categories', 'budgetFinal', 'closedBudget', 'budgetModel'));
  }

  public function create()
  {
    if (auth()->get()->is_super_admin != 1) {
      sezzion()->tempset('error', 'Vous n\'avez pas l\'autorisation necessaire.');
      $this->app->redirect('/');
      return;
    }

    $departementModels = Departement::all();
    $departements = IndexController::mapDepartementModels($departementModels);

    piewpiew('pages.departement.form', compact('departements'));
  }

  public function doCreate()
  {
    if (auth()->get()->is_super_admin != 1) {
      sezzion()->tempset('error', 'Vous n\'avez pas l\'autorisation necessaire.');
      $this->app->redirect('/', 400);
      return;
    }

    $datas = $this->app->request()->data->getData();
    $error = check_input($datas, [
      'name' => "required;unique:name," . (new Departement)->table,
    ], [
      'name:required' => 'Le nom est requis',
      'name:unique' => 'Ce departement existe deja',
    ]);

    $icon = $datas['icon'] ?? ($datas['icon-custom'] ?? null);

    if ($icon === null) {
      sezzion()->tempset('error', 'Veuillez choisir une icone');
      $this->app->redirect('/departements/create');
      return;
    }

    if ($error !== true) {
      sezzion()->tempset('error', $error[0]);
      $this->app->redirect('/departements/create');
      return;
    }

    $departement = new Departement;
    $departement->name = $datas['name'];
    $departement->icon = $icon;

    $res = $departement->insert();

    if ($res) {
      sezzion()->tempset('success', 'Departement cree.');
    } else {
      sezzion()->tempset('error', 'Il y a eu une erreur, veuillez reessayer...');
    }
    $this->app->redirect('/departements/create');
  }
}
