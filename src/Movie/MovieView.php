<?php

declare(strict_types=1);

namespace src\Movie;

use src\View;

class MovieView extends View
{
    public function displayMovies(int $counter, array $movies): void
    {
        $content = dirname(__DIR__) . '/../templates/movie_list.html';
        $title = 'Movie List'; // Le titre de la page
        include dirname(__DIR__) . '/../templates/layout.html';
    }
}