<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Categorie;
use app\models\Type;
use flight\Engine;

class TypeController
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
    $id_categorie = $this->app->request()->data->id_categorie;
    $categorie = Categorie::find($id_categorie);
    $designation = $this->app->request()->data->designation;

    if ($categorie == null) {
      sezzion()->tempset('error', 'Categorie introuvable...');
      $this->app->redirect('/');
      return;
    }

    // TODO: Check the user

    $res = Type::create([
      'designation' => $designation,
      'id_categorie' => $id_categorie
    ]);

    if ($res)
      sezzion()->tempset('success', 'Type cree...');
    else
      sezzion()->tempset('error', 'Veuillez reessayer...');

    $this->app->redirect('/departements/' . $categorie->id_departement);
  }
}
