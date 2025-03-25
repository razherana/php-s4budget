<?php

use app\controllers\AuthController;
use app\controllers\BudgetController;
use app\controllers\CategorieController;
use app\controllers\DepartementController;
use app\controllers\ImportController;
use app\controllers\IndexController;
use app\controllers\PrevisionController;
use app\controllers\TestController;
use app\controllers\TypeController;
use app\controllers\UserController;
use app\middlewares\AuthMiddleware;
use app\middlewares\SuperAdminMiddleware;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// for testing purposes
$tests = new TestController($app);
$router->get('/test/@id', [new DepartementController($app), 'toPdf']);

// Logins
$authController = new AuthController($app);

$router->get('/login', [$authController, 'login']);
$router->post('/login', [$authController, 'doLogin']);
$router->get('/logout', [$authController, 'logout']);
$router->post('/logout', [$authController, 'logout']);

// Main container to keep all routes require a login
$router->group('', function () use ($app, $router) {
  $indexController = new IndexController($app);
  $router->get('/', [$indexController, 'dashboard']);

  $departementController = new DepartementController($app);
  $router->get('/departements/create', [$departementController, 'create']);
  $router->post('/departements/create', [$departementController, 'doCreate']);

  $categorieController = new CategorieController($app);
  $router->post('/departements/categories', [$categorieController, 'doCreate']);

  $typeController = new TypeController($app);
  $router->post('/departements/types', [$typeController, 'doCreate']);

  $previsionController = new PrevisionController($app);
  $router->post('/departements/previsions', [$previsionController, 'doCreate']);

  $router->group('/departements/@id', function () use ($app, $router, $departementController) {
    $router->get('', [$departementController, 'show']);

    $budgetController = new BudgetController($app);
    $router->post('/budget', [$budgetController, 'updateOrInsert']);
  });
}, [new AuthMiddleware]);

$router->group('', function () use ($app, $router) {
  $userController = new UserController($app);
  $router->get('/users/manage', [$userController, 'list']);
  $router->post('/users/manage', [$userController, 'doCreate']);

  $importController = new ImportController($app);
  $router->get('/import', [$importController, 'form']);
  $router->post('/import', [$importController, 'doImport']);

  $budgetController = new BudgetController($app);
  $router->get('/budgets/@id/lock', [$budgetController, 'toggleLock']);

  $previsionController = new PrevisionController($app);
  $router->get('/previsions/@id/lock', [$previsionController, 'toggleLock']);
}, [new SuperAdminMiddleware]);
