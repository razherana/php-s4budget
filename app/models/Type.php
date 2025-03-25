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
}
