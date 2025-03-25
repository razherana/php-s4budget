<?php

declare(strict_types=1);

namespace app\controllers;

use flight\Engine;
use app\models\Budget;
use app\models\Categorie;
use app\models\Departement;
use app\models\Prevision;
use app\models\Type;
use Exception;
use Lorm\Lorm;

class ImportController
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

  public function form()
  {
    piewpiew('pages.import.form');
  }

  public function doImport()
  {
    if (!(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0)) {
      sezzion()->tempset('error', 'Le fichier est requis');
      $this->app->redirect('/import');
      return;
    }

    $filename = $_FILES["file"]["tmp_name"];

    if (($handle = fopen($filename, "r")) == false) {
      sezzion()->tempset('error', 'Erreur d\'ouverture');
      $this->app->redirect('/import');
      return;
    }

    Lorm::get_pdo()->beginTransaction();

    $section = "";
    while (($data = fgetcsv($handle, null, ",", '"', "\\"))) {
      if (count($data) == 1 && $data[0][0] == "-") {
        $section = trim($data[0]);
      } else {
        $section_ = ltrim($section, "-");
        if ($data[0][0] != "-") {

          if ($section_ == "Departement") {
            Departement::create([
              'name' => $data[0],
              'icon' => $data[1]
            ]);
          }
          if ($section_ == "Budget") {
            Budget::create([
              'id_departement' => $data[0],
              'solde' => $data[1],
              'updated_at' => $data[2]
            ]);
          }
          if ($section_ == "Categorie") {
            Categorie::create([
              'designation' => $data[0],
              'id_departement' => $data[1]
            ]);
          }
          if ($section_ == "Type") {
            Type::create([
              'designation' => $data[0],
              'id_categorie' => $data[1]
            ]);
          }
          if ($section_ == "Prevision") {
            Prevision::create([
              'designation' => $data[0],
              'realisation' => $data[1],
              'prevision' => $data[2],
              'type' => $data[3],
              'id_type' => $data[4],
              'date' => $data[5],
            ]);
          }
        }
      }
    }

    Lorm::get_pdo()->commit();

    fclose($handle);

    sezzion()->tempset('success', 'Les donnees sont inserees avec success dans la base de donnees.');
    $this->app->redirect('/import');
  }
}
