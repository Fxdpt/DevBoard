<?php

namespace App\Database\Collector;

use App\Database\Adapter\PDOConnection;

class PDOQueryCollector
{
    private $statements = [];

    public function __construct(PDOConnection $pdoConnection)
    {
        $this->statements = $pdoConnection->getStatements();
    }

    public function getQueriesData()
    {
        $queriesData = [];

        foreach($this->statements as $index => $query) {
            $queriesData[$index] = [
                'statement' => $query->queryString,
                'duration' => $query->getExecTime(),
                'params' => $query->getParams(),
            ];
        }
    }
}