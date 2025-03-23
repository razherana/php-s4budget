<?php

use app\controllers\AuthController;
use app\controllers\IndexController;
use app\controllers\TestController;
use app\middlewares\AuthMiddleware;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// for testing purposes
$tests = new TestController($app);

// Logins
$authController = new AuthController($app);

$router->get('/login', [$authController, 'login']);
$router->post('/login', [$authController, 'doLogin']);
$router->get('/logout', [$authController, 'logout']);

// Main container to keep all routes require a login
$router->group('', function () use ($app, $router) {
  $indexController = new IndexController($app);
  $router->get('/', [$indexController, 'dashboard']);
}, [new AuthMiddleware]);
