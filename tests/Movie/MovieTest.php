<?php

declare(strict_types=1);

namespace tests\src\Movie;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use src\Movie\Movie;

#[CoversClass(Movie::class)]
#[UsesClass(Movie::class)]

final class MovieTest extends TestCase
{
    public function testFetchAllMovies(): void
    {
        $movie = new Movie();
        $movies = $movie->fetchAllMovies();

        $this->assertNotEmpty($movies, 'Movies should not be empty');

        foreach ($movies as $movie) {
            $this->assertArrayHasKey('titre', $movie, 'Each movie should have a title');
            $this->assertIsString($movie['titre'], 'Title should be a string');
        }
    }

}
