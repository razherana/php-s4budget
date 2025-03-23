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
    piewpiew('pages.dashboard');
  }
}
