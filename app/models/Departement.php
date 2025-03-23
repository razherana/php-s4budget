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
    'name'
  ];
}
