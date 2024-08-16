<?php

declare(strict_types=1);

namespace src\Movie;

class Movie
{
    public function __construct(
        private MovieRepository $movieRepository
    ) {
    }
    public function fetchAllMovies(): array
    {
        return $this->movieRepository->selectAllMovies();
    }

    public function fetchMoviesByGenre(string $genre): array
    {
        return $this->movieRepository->selectMoviesByGenre($genre);
    }
}