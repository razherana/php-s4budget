<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Budget;
use app\models\Categorie;
use app\models\Departement;
use app\models\Prevision;
use app\models\Type;
use DateTime;
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
  private function normalizedCategorieData($departement, $annee)
  {
    if ($annee === null)
      return ['mois' => [], 'categories' => []];

    $mois = [];

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
          'totalPrevision1' => [],
          'totalPrevision2' => [],
          'totalRealisation1' => [],
          'totalRealisation2' => []
        ]
      ];
    }

    $result_previsions = [];

    $totalPrevision1s = [];
    $totalPrevision2s = [];
    $totalRealisation1s = [];
    $totalRealisation2s = [];

    foreach (array_filter(Prevision::all(), fn($e) => (new DateTime($e->date))->format('Y') == $annee) as $prevision) {
      if (empty($result_types[$prevision->id_type]))
        continue;

      $result_previsions[$prevision->id] = [
        'id' => $prevision->id,
        'prevision' => $prevision->prevision,
        'realisation' => $prevision->realisation,
        'designation' => $prevision->designation,
        'date' => $prevision->date,
        'type' => $prevision->type,
        'id_type' => $prevision->id_type,
        'locked' => $prevision->locked
      ];

      $id_type = intval($prevision->id_type);
      $mois_ = intval((new DateTime($prevision->date))->format('m'));

      $totalPrevision1s[$id_type] = $totalPrevision1s[$id_type] ?? [];
      $totalRealisation1s[$id_type] = $totalRealisation1s[$id_type] ?? [];
      $totalPrevision2s[$id_type] = $totalPrevision2s[$id_type] ?? [];
      $totalRealisation2s[$id_type] = $totalRealisation2s[$id_type] ?? [];

      $mois[$mois_] = $mois_;

      if (!isset($totalPrevision1s[$id_type][$mois_]))
        $totalPrevision1s[$id_type][$mois_] = 0;

      if (!isset($totalRealisation1s[$id_type][$mois_]))
        $totalRealisation1s[$id_type][$mois_] = 0;

      if (!isset($totalPrevision2s[$id_type][$mois_]))
        $totalPrevision2s[$id_type][$mois_] = 0;

      if (!isset($totalRealisation2s[$id_type][$mois_]))
        $totalRealisation2s[$id_type][$mois_] = 0;

      if (!$prevision->locked)
        continue;

      if ($prevision->type == 0) {
        $totalPrevision1s[$id_type][$mois_] += $prevision->prevision;
        $totalRealisation1s[$id_type][$mois_] += $prevision->realisation;
      } else {
        $totalPrevision2s[$id_type][$mois_] += $prevision->prevision;
        $totalRealisation2s[$id_type][$mois_] += $prevision->realisation;
      }
    }

    // Combine
    foreach ($result_previsions as $v) {
      $type = $v['type'];
      $m = intval((new DateTime($v['date']))->format('m'));

      $result_types[$v['id_type']]['previsions']['previsions1'][$m] = $result_types[$v['id_type']]['previsions']['previsions1'][$m] ?? [];
      $result_types[$v['id_type']]['previsions']['previsions2'][$m] = $result_types[$v['id_type']]['previsions']['previsions2'][$m] ?? [];

      $result_types[$v['id_type']]['previsions'][$type == 0 ? 'previsions1' : 'previsions2'][$m][] = $v;
    }

    foreach ($result_types as $v) {
      $v['previsions']['totalPrevision1'] = $totalPrevision1s[$v['id']] ?? [];
      $v['previsions']['totalPrevision2'] = $totalPrevision2s[$v['id']] ?? [];
      $v['previsions']['totalRealisation1'] = $totalRealisation1s[$v['id']] ?? [];
      $v['previsions']['totalRealisation2'] = $totalRealisation2s[$v['id']] ?? [];

      $result[$v['id_categorie']]['types'][] = $v;
    }

    return ['mois' => array_values($mois), 'categories' => $result];
  }

  public function show($id)
  {
    $departement = Departement::find($id);

    $annee = $_GET['annee'] ?? null;

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

    ['mois' => $mois, 'categories' => $categories] = $this->normalizedCategorieData($departement, $annee);

    sort($mois);

    $budgetFinal = "Pas de Budget Initial";

    if ($hasBudget) {
      $budgetFinal = $budget->solde;

      foreach ($categories as $categorie)
        foreach ($categorie['types'] as $type) {
          $budgetFinal -= array_sum($type['previsions']['totalPrevision1']);
          $budgetFinal += array_sum($type['previsions']['totalPrevision2']);
        }

      $budget = $budget->solde . " Ar";
      $budgetFinal = $budgetFinal . " Ar";
    }

    $closedBudget = (bool) $budgetModel->locked;

    piewpiew('pages.departement.departement', compact('annee', 'departement', 'budget', 'departements', 'hasBudget', 'categories', 'budgetFinal', 'closedBudget', 'budgetModel', 'mois'));
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
