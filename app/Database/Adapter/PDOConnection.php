<?php

namespace App\Database\Adapter;

use PDO;
use PDOStatement;

class PDOConnection extends PDO
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
        parent::__construct($dsn, $username, $password, $options);
        $this->setAttribute(PDO::ATTR_STATEMENT_CLASS, ['\App\Database\Adapter\PDODevboardStatement']);
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
