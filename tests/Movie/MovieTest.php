<?php

declare(strict_types=1);

namespace tests\src\Movie;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use src\Movie\Movie;
use src\Repository;

#[CoversClass(Movie::class)]
#[UsesClass(Movie::class)]

final class MovieTest extends TestCase
{

    protected function setUp(): void
    {
        $this->movie = new Movie();
    }

    /**
     * @throws Exception
     */
    public function testEmptyMoviesArray()
    {
        $movieMock = $this->createMock(Movie::class);

        $movieMock->method('fetchAllMovies')
            ->willReturn([]);

        $movies = $movieMock->fetchAllMovies();
        $this->assertEmpty($movies, 'Array should not be empty.');
    }

    /**
     * @throws Exception
     */
    public function testMoviesHaveTitleKey()
    {
        $movieMock = $this->createMock(Movie::class);

        $movies = [
            ['titre' => ''],
        ];

        $movieMock->method('fetchAllMovies')
            ->willReturn($movies);

        $movies = $movieMock->fetchAllMovies();

        foreach ($movies as $movie) {
            $this->assertArrayHasKey('titre', $movie, 'There should be a title key in movie array.');
        }
    }

    /**
     * @throws Exception
     */
    public function testTitlesAreStrings()
    {
        $movieMock = $this->createMock(Movie::class);

        $movies = [
            ['titre' => '111'],
        ];

        $movieMock->method('fetchAllMovies')
            ->willReturn($movies);

        $movies = $movieMock->fetchAllMovies();

        foreach ($movies as $movie) {
            $this->assertIsString($movie['titre'], 'Title should be a string.');
        }
    }

    /**
     * @throws Exception
     */
    public function testTitlesAreNotEmpty()
    {
        $repositoryMock = $this->createMock(Repository::class);

        $repositoryMock->method('query')
            ->willReturn([
                ['titre' => ''],
                ['titre' => '   '],
            ]);

        $movie = new Movie($repositoryMock);
        $movies = $movie->fetchAllMovies();

        foreach ($movies as $movie) {
            $title = trim($movie['titre']);
            $this->assertNotEmpty($title, 'Movie title should not be empty or just whitespace.');
        }
    }

}