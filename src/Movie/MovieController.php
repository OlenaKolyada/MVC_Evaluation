<?php

declare(strict_types=1);

namespace src\Movie;

class MovieController
{
    public function __construct(
        private Movie $movie,
        private MovieView $movieView
    ) {
    }

    public function getAllMovies(): void
    {
        $movies = $this->movie->fetchAllMovies();
        $this->renderMovies($movies);
    }

    public function getMoviesByGenre(): void
    {
        $genre = $_POST['genreSelect'] ?? '';
        $movies = $this->movie->fetchMoviesByGenre($genre);
        $this->renderMovies($movies);
    }

    public function renderMovies(array $movies): void
    {
        $counter = count($movies);
        $this->movieView->displayMovies($counter, $movies);
    }

}