<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Budget;
use app\models\Departement;
use flight\Engine;

class BudgetController
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

  public function updateOrInsert()
  {
    $id_departement = intval($this->app->request()->data->id_departement);

    $departement = Departement::find($id_departement);

    if ($departement == null || ($departement->id != auth()->get()->id_departement && auth()->get()->is_super_admin != 1)) {
      sezzion()->tempset('error', 'Vous manquez d\'autorisation ou le departement n\'existe pas...');
      $this->app->redirect('/');
      return;
    }

    $budgets = Budget::doquery()->where('id_departement', '=', $id_departement)->get();

    $solde = $this->app->request()->data->solde;
    if (str_ends_with($solde, 'Ar')) {
      $solde = intval(substr($solde, 0, -2));
    }

    if (empty($budgets)) {
      $budget = new Budget();
      $budget->id_departement = $id_departement;
      $budget->solde = intval($solde);
      $budget->updated_at = date('Y-m-d H:i:s');
      $res = $budget->insert();
    } else {
      $budget = $budgets[array_keys($budgets)[0]];
      $budget->solde = intval($solde);
      $budget->updated_at = date('Y-m-d H:i:s');
      $res = $budget->update();
    }

    if ($res) {
      sezzion()->tempset('success', 'Budget updated');
    } else {
      sezzion()->tempset('error', 'Failed to update budget');
    }

    $annee = isset($_GET['annee']) ? ('?annee=' . $_GET['annee']) : '';

    $this->app->redirect('/departements/' . $id_departement . $annee);
  }

  public function toggleLock($id)
  {
    $budget = Budget::find($id);

    if ($budget == null) {
      sezzion()->tempset('error', 'Le budget n\'existe pas');
      $this->app->redirect('/');
      return;
    }

    $budget->locked = $budget->locked ?? 0;
    $budget->locked = ($budget->locked + 1) % 2;
    $res = $budget->update();

    if ($res) {
      sezzion()->tempset('success', 'Budget locked/unlocked');
    } else {
      sezzion()->tempset('error', 'Failed to update budget');
    }

    $annee = isset($_GET['annee']) ? ('?annee=' . $_GET['annee']) : '';
    $this->app->redirect('/departements/' . $budget->id_departement . $annee);
  }
}
