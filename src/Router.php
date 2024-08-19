<?php

declare(strict_types=1);

namespace src;

readonly class Router
{
    public function run(): void
    {
        $controllerName = $_GET['c'] ?? 'MovieController';
        $methodName = $_GET['m'] ?? 'getAllMovies';

        $namespace = match ($controllerName) {
            'MovieController' => 'src\\Movie\\',
            default => 'src\\',
        };

        $controllerClass = $namespace . $controllerName;

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            $controller->$methodName();
        } else {
            $view = new View();
            $view->display404();
        }
    }
}