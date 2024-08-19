<?php

declare(strict_types=1);

namespace src;

class View
{
    public function display404(): void
    {
        $content = dirname(__DIR__) . '/templates/404.html';
        $title = '404 Not Found';
        include dirname(__DIR__) . '/templates/layout.html';
    }
}