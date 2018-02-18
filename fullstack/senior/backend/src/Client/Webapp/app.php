<?php
declare(strict_types=1);

if (file_exists(ROOT_PATH.'/vendor/autoload.php') === false) {
    echo "run this command first: composer install";
    exit();
}
require_once ROOT_PATH.'/vendor/autoload.php';

use Silex\Application;

$app = new Application();

// Loads the app config
$app['config'] = include ROOT_PATH.'/config/app.php';

// Registers the service providers
$app->register(new Silex\Provider\VarDumperServiceProvider());
$app->register(new \IWD\JOBINTERVIEW\Provider\AppServiceProvider());
$app->register(new \IWD\JOBINTERVIEW\Provider\ApiServiceProvider());

// Runs the app
$app->run();

return $app;
