<?php

namespace App\Database\Adapter;

use PDO;
use PDOException;
use PDOStatement;

class PDODevboardConnection extends PDO
{
    private $statements = [];

    public function __construct(
        string $host,
        string $basename,
        string $username,
        string $password = null,
        array $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
        int $port = 3306
    ) {
        $dsn = "mysql:dbname={$basename};host={$host};port={$port}";
        try {
            parent::__construct($dsn, $username, $password, $options);
            $this->setAttribute(PDO::ATTR_STATEMENT_CLASS, ['\App\Database\Adapter\PDODevboardStatement']);
        } catch (PDOException $e) {
            throw new PDODevboardException($e);
        }
    }

    public function getStatements(): array
    {
        return $this->statements;
    }

    public function prepare($statement, $options = []): PDOStatement
    {
        $currentStatement = parent::prepare($statement, $options);
        $this->statements[] = $currentStatement;
        return $currentStatement;
    }
}
