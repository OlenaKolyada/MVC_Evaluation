<?php

declare(strict_types=1);

namespace src;

class Repository
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

    public function query(string $sql): array
    {
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function execute(string $sql, array $params = []): ?array
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


}