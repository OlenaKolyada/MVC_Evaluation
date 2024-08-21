<?php

declare(strict_types=1);

namespace src\Movie;

use src\Repository;

class Movie
{
    private Repository $repository;
    public function __construct() {
        $this->repository = new Repository();
    }

    public function fetchAllMovies(): array
    {
        $sql = "SELECT * FROM `film`";
        $movies = $this->repository->query($sql);

        $filteredMovies = array_filter($movies, function ($movie) {
            if (isset($movie['titre']) && is_string($movie['titre'])) {
                $trimmedTitle = trim($movie['titre']);
                return $trimmedTitle !== '' && !ctype_digit($trimmedTitle);
            }
            return false;
        });


//        var_dump($filteredMovies, true);

        return array_values($filteredMovies);
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
