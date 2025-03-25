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
    'date'
  ];
}