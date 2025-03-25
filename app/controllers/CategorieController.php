<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Categorie;
use app\models\Departement;
use flight\Engine;

class CategorieController
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

  public function doCreate()
  {
    $id_departement = $this->app->request()->data->id_departement;
    $departement = Departement::find($id_departement);

    $designation = $this->app->request()->data->designation;

    if ($departement == null) {
      sezzion()->tempset('error', 'Departement introuvable...');
      $this->app->redirect('/');
      return;
    }

    // TODO: Check the user

    $res = Categorie::create([
      'designation' => $designation,
      'id_departement' => $id_departement
    ]);

    if ($res) {
      sezzion()->tempset('success', 'Categorie cree...');
    } else {
      sezzion()->tempset('error', 'Veuillez reessayer...');
    }

    $annee = isset($_GET['annee']) ? ('?annee=' . $_GET['annee']) : '';
    $this->app->redirect('/departements/' . $id_departement . $annee);
  }
}
