<?php

declare(strict_types=1);

namespace app\controllers;

use flight\Engine;

class TestController
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

  public function dashboard()
  {
    $departements = [
      '/departements/1' => ['Direction', 'fa fa-building'],
      '/departements/2' => ['Finance', 'fa fa-briefcase'],
      '/departements/3' => ['Ressources Humaines', 'fa fa-users'],
    ];
    piewpiew('pages.dashboard', ['departements' => $departements]);
  }

  public function login()
  {
    piewpiew('pages.login');
  }

  public function innerTable()
  {
    piewpiew('tests.division');
  }
}
