<?php

declare(strict_types=1);

namespace app\controllers;

use flight\Engine;

class AuthController
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

  public function login()
  {
    piewpiew('pages/login');
  }

  public function doLogin()
  {
    // TODO: Implement checking datas

    $email = $this->app->request()->data->email;
    $password = $this->app->request()->data->password;

    $result = auth()->login([
      'id_column' => [
        'email' => $email,
      ],
      'pass_column' => $password
    ]);

    if ($result) {
      $this->app->redirect('/');
    } else {
      sezzion()->tempset('error', 'Invalid email or password');
      $this->app->redirect('/login');
    }
  }

  public function logout()
  {
    auth()->logout();
    sezzion()->tempset('success', 'You have been logged out');
    $this->app->redirect('/login');
  }
}
