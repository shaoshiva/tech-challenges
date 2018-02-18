<?php

declare(strict_types=1);

define('ROOT_PATH', realpath('.'));

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

$app = require_once 'src/Client/Webapp/app.php';
