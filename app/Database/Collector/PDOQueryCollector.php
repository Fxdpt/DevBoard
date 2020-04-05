<?php

namespace App\Database\Collector;

use App\Database\Adapter\PDODevboardConnection;
use App\Database\Logger\PDOLogger;

class PDOQueryCollector
{
    private $statements = [];
    private $logger;

    public function __construct(PDODevboardConnection $pdoConnection)
    {
        $this->statements = $pdoConnection->getStatements();
        $this->logger = new PDOLogger();
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
        $this->logger->addToLogFile($queriesData);
        return $queriesData;
    }
}