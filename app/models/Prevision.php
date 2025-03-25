<?php

namespace app\models;

use Lorm\BaseModel;

class Prevision extends BaseModel
{
  public $primary_key = "id";

  public $table = "Prevision";

  /**
   * The model's columns
   * @var string[]
   */
  public $columns = [
    'id',
    'designation',
    'realisation',
    'prevision',
    'type',
    'id_type',
    'date',
    'locked',
  ];

  public function typeModel()
  {
    return $this->belongsTo(Type::class, fn($p, $t) => $p->id_type == $t->id, 'typeModel');
  }
}
