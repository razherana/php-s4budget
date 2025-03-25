<?php

namespace app\models;

use Lorm\BaseModel;

class Budget extends BaseModel
{
  public $primary_key = "id";

  public $table = "Budget";

  /**
   * The model's columns
   * @var string[]
   */
  public $columns = [
    'id',
    'id_departement',
    'solde',
    "locked",
    'updated_at'
  ];

  public static function getCurrent($id)
  {
    $all = self::doquery()->where('id_departement', '=', $id)->get();

    usort($all, function ($b, $a) {
      return $a->updated_at <=> $b->updated_at;
    });

    $budget = @($all[array_keys($all)[0]] ?? 'Pas de Budget');
    return $budget;
  }
}
