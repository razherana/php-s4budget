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

  /**
   * Map departement models
   * @param Departement[] $departementModels
   */
  public static function mapDepartementModels($departementModels)
  {
    $departements = [];

    foreach ($departementModels as $departement)
      $departements['/departements/' . $departement->id] = [$departement->name, $departement->icon ?? 'fa fa-building'];

    return $departements;
  }

  public function dashboard()
  {
    $authedUser = auth()->get();

    if ($authedUser->is_super_admin == 1) {
      $departementModels = Departement::all();
    } else {
      $departementModels = Departement::doquery()->where('id', '=', $authedUser->id_departement)->get();
    }

    piewpiew('pages.dashboard', ['departements' => self::mapDepartementModels($departementModels)]);
  }
}
