<?php

namespace app\models;

use DateTime;
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

  /**
   * Apply all previsions before a date
   * @param int $budgetFinal
   * @param Prevision $prevision
   * @param Departement $departement
   * @param int $year
   */
  public static function applyBeforeDate($budgetFinal, $previsions, $departement, $year): float
  {
    $categories = Categorie::doquery()->where('id_departement', '=', $departement->id)->preload([
      'types'
    ])->get();

    $types = [];
    foreach ($categories as $cat)
      foreach ($cat->types as $type)
        $types[$type->id] = 1;

    foreach ($previsions as $p) {
      if (!isset($types[$p->id_type]) || !$p->locked || (new DateTime($p->date))->format('Y') >= $year)
        continue;
      $budgetFinal += ($p->type == 1 ? 1 : -1) * $p->realisation;
    }

    return $budgetFinal;
  }
}
