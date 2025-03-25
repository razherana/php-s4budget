<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Departement;
use app\models\User;
use flight\Engine;

class UserController
{
  /** @var Engine */
  protected Engine $app;

  /**
   * Constructor
   */
  public function __construct(Engine $app)
  {
    $this->app = $app;
  }

  public function list()
  {
    $departementModels = Departement::all();
    $departements = IndexController::mapDepartementModels($departementModels);

    $users = User::all(
      ['eager_load' => [
        'departement'
      ]]
    );

    piewpiew('pages.users.list', compact('departements', 'departementModels', 'users'));
  }

  public function doCreate()
  {
    $res = auth()->register(
      [
        'name' => $this->app->request()->data->name,
        'email' => $this->app->request()->data->email,
        'password' => $this->app->request()->data->password,
        'id_departement' => !is_null($this->app->request()->data->departement) ? $this->app->request()->data->departement :-1,
        'is_super_admin' => intval($this->app->request()->data->is_super_admin) ?? 0
      ]
    );

    if (!$res) {
      sezzion()->tempset('error', 'Could not create user');
    } else {
      sezzion()->tempset('success', 'User created');
    }

    $this->app->redirect('/users/manage');
  }
}
