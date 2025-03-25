<?php

namespace app\models;

use Lorm\BaseModel;

class Categorie extends BaseModel
{
  public $primary_key = "id";

  public $table = "Categorie";

  /**
   * The model's columns
   * @var string[]
   */
  public $columns = [
    'id',
    'designation',
    'id_departement'
  ];

  public function departement()
  {
    return $this->belongsTo(Departement::class, fn($c, $d) => $c->id_departement == $d->id, 'departement');
  }

  public function types() {
    return $this->hasMany(Type::class, fn($c, $t) => $c->id == $t->id_categorie, 'types');
  }
}
