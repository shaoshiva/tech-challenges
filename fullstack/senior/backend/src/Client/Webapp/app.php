<?php
declare(strict_types=1);

if (file_exists(ROOT_PATH.'/vendor/autoload.php') === false) {
    echo "run this command first: composer install";
    exit();
}
require_once ROOT_PATH.'/vendor/autoload.php';

use Silex\Application;

$app = new Application();

$app['config'] = include ROOT_PATH.'/config/app.php';
$app['debug'] = $app['config']['debug'] ?? false;

/**
 * Service providers
 */

$app->register(new Silex\Provider\VarDumperServiceProvider());
$app->register(new \IWD\JOBINTERVIEW\Provider\AppServiceProvider());
$app->register(new \IWD\JOBINTERVIEW\Provider\ApiServiceProvider());

$app->run();

return $app;
