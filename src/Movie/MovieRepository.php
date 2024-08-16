<?php

declare(strict_types=1);

namespace src\Movie;

use src\BaseRepository;

class MovieRepository extends BaseRepository
{
    public function selectAllMovies(): array
    {
        $sql = "SELECT * FROM `film`";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectMoviesByGenre(string $genre): array
    {
        $sql = "
        SELECT f.*
        FROM film f
        JOIN appartenir a ON f.id_film = a.id_film
        JOIN genre g ON a.id_genre = g.id_genre
        WHERE g.genre = :genre
    ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':genre', $genre, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}