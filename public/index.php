<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use src\Router;

$router = new Router();
$router->run();
