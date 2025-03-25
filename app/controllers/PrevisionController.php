<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Categorie;
use app\models\Prevision;
use app\models\Type;
use flight\Engine;

class PrevisionController
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
    $id_type = $this->app->request()->data->id_type;

    $type = Type::find($id_type);

    if ($type == null) {
      sezzion()->tempset('error', 'Type introuvable...');
      $this->app->redirect('/');
      return;
    }

    $prevision = new Prevision;
    $prevision->id_type = $id_type;
    $prevision->designation = $this->app->request()->data->designation;
    $prevision->date = $this->app->request()->data->date;
    $prevision->prevision = $this->app->request()->data->prevision;
    $prevision->realisation = $this->app->request()->data->realisation;
    $prevision->type = $this->app->request()->data->type;
    $res = $prevision->insert();

    if ($res) {
      sezzion()->tempset('success', 'Prévision ajoutée avec succès');
    } else {
      sezzion()->tempset('error', 'Erreur lors de l\'ajout de la prévision');
    }

    $this->app->redirect('/departements/' . Categorie::find(Type::find($id_type)->id_categorie)->id_departement);
  }
}
