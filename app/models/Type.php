<?php

namespace app\models;

use Lorm\BaseModel;

class Type extends BaseModel
{
  public $primary_key = "id";

  public $table = "Type";

  /**
   * The model's columns
   * @var string[]
   */
  public $columns = [
    'id',
    'designation',
    'id_categorie'
  ];

  public function categorie()
  {
    return $this->belongsTo(Categorie::class, fn($t, $c) => $t->id_categorie == $c->id, 'categorie');
  }
}
