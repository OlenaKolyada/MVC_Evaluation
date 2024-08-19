<?php

declare(strict_types=1);

namespace src;

use src\View;

class Router
{
    private static ?View $view = null;

    public function __construct(View $view)
    {
        self::$view = $view;
    }

    public static function run(): void
    {
        $controllerName = $_GET['c'] ?? 'MovieController';
        $methodName = $_GET['m'] ?? 'getAllMovies';

        $namespace = 'src\\Controller\\';
        $controllerClass = $namespace . $controllerName;

        if (class_exists($controllerClass)) {
            $controller = self::createControllerInstance($controllerClass);

            if (method_exists($controller, $methodName)) {
                $controller->$methodName();
            } else {
                self::$view->display404();
            }
        } else {
            self::$view->display404();
        }
    }

    private static function createControllerInstance(string $controllerClass)
    {
        if ($controllerClass === 'src\\Controller\\MovieController') {
            return self::createMovieController();
        }

        return new $controllerClass();
    }

    private static function createMovieController(): \src\Movie\MovieController
    {
        $repository = new \src\Repository();
        $movieView = new \src\Movie\MovieView();
        $movie = new \src\Movie\Movie($repository);
        return new \src\Movie\MovieController($movie, $movieView);
    }

}
