<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Departement;
use flight\Engine;

class IndexController
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

  public function dashboard()
  {
    $authedUser = auth()->get();

    if ($authedUser->is_super_admin == 1) {
      $departementModels = Departement::all();
    } else {
      $departementModels = Departement::doquery()->where('id', '=', $authedUser->id_departement)->get();
    }

    $randomIcons = [
      'fa fa-building',
      'fa fa-briefcase',
      'fa fa-users',
      'fa fa-cogs',
      'fa fa-balance-scale',
      'fa fa-balance-scale-right',
      'fa fa-balance-scale-left',
    ];

    $departements = [];
    $i = 0;

    foreach ($departementModels as $departement) {
      $departements['/departements/' . $departement->id] = [$departement->name, $randomIcons[$i]];
      $i = ($i + 1) % count($randomIcons);
    }

    piewpiew('pages.dashboard', ['departements' => $departements]);
  }
}
