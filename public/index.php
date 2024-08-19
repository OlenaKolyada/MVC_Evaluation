<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use src\Router;
use src\View;

$view = new View();
$router = new Router($view);
$router->run();
