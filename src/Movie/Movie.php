<?php

declare(strict_types=1);

namespace src\Movie;

use src\Repository;

readonly class Movie
{
    private Repository $repository;
    public function __construct() {
        $this->repository = new Repository();
    }
    public function fetchAllMovies(): array
    {
        $sql = "SELECT * FROM `film`";
        return $this->repository->query($sql);
    }

    public function fetchMoviesByGenre(string $genre): array
    {
        $sql = "SELECT f.*
                FROM film f
                JOIN appartenir a ON f.id_film = a.id_film
                JOIN genre g ON a.id_genre = g.id_genre
                WHERE g.genre = :genre";
        $params = [':genre' => $genre];

        return $this->repository->execute($sql, $params);
    }
}