<?php

namespace app\models;

use Lorm\BaseModel;

class User extends BaseModel
{
  public $primary_key = "id";

  public $table = "User";

  /**
   * The model's columns
   * @var string[]
   */
  public $columns = [
    'id',
    'name',
    'email',
    'password',
    'id_departement',
    'is_super_admin'
  ];

  public function departement()
  {
    return $this->belongsTo(Departement::class, fn($u, $d) => $u->id_departement == $d->id, 'departement');
  }
}
