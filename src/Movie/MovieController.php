<?php

declare(strict_types=1);

namespace src\Movie;

readonly class MovieController
{
    private Movie $movie;
    private MovieView $movieView;

    public function __construct() {
        $this->movie = new Movie();
        $this->movieView = new MovieView();
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