<?php

namespace app\models;

use Lorm\BaseModel;

class Departement extends BaseModel
{
  public $primary_key = "id";

  public $table = "Departement";

  /**
   * The model's column
   * @var string[]
   */
  public $columns = [
    'id',
    'name',
    'icon'
  ];

  public function categories()
  {
    return $this->hasMany(Categorie::class, fn($d, $c) => $d->id == $c->id_departement, 'categories');
  }
}
