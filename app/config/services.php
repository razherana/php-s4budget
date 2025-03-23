<?php

use flight\Engine;
use flight\database\PdoWrapper;
use flight\debug\database\PdoQueryCapture;
use Lorm\Lorm;
use Tracy\Debugger;

/** 
 * @var array $config This comes from the returned array at the bottom of the config.php file
 * @var Engine $app
 */

session_start();

// uncomment the following line for MySQL
$dsn = 'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['dbname'] . ';charset=utf8mb4';

$ds = DIRECTORY_SEPARATOR;
require_once __DIR__ . "{$ds}..{$ds}..{$ds}php_modules{$ds}modules.php";

// uncomment the following line for SQLite
// $dsn = 'sqlite:' . $config['database']['file_path'];

// Uncomment the below lines if you want to add a Flight::db() service
// In development, you'll want the class that captures the queries for you. In production, not so much.
$pdoClass = Debugger::$showBar === true ? PdoQueryCapture::class : PdoWrapper::class;
$app->register('db', $pdoClass, [$dsn, $config['database']['user'] ?? null, $config['database']['password'] ?? null]);

Flight::map('notFound', function() {
	echo '<h1>404 Not Found</h1>';
	echo '<h3>The page you have requested could not be found.</h3>';
	Flight::halt(404);
});

Lorm::set_pdo($app->db());

define("BASE_URL", rtrim($app->get('flight.base_url'), "/"));

function route($url = "")
{
  return BASE_URL . "/" . $url;
}
// Got google oauth stuff? You could register that here
// $app->register('google_oauth', Google_Client::class, [ $config['google_oauth'] ]);

// Redis? This is where you'd set that up
// $app->register('redis', Redis::class, [ $config['redis']['host'], $config['redis']['port'] ]);
