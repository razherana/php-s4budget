<?php

use app\controllers\TestController;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// for testing purposes
$tests = new TestController($app);

$router->get('/', [$tests, 'dashboard']);
