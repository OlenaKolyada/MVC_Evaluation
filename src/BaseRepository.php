<?php

declare(strict_types=1);

namespace src;

class BaseRepository
{
    protected \PDO $pdo;

    public function __construct()
    {
        $this->connectToDatabase();
    }

    private function connectToDatabase(): void
    {
        $config = require __DIR__ . '/../config.php';
        $dbConfig = $config['db'];

        $this->pdo = new \PDO(
            "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}",
            $dbConfig['user'],
            $dbConfig['password']
        );
    }
}