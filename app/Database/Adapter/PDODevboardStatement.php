<?php

namespace App\Database\Adapter;

use PDO;
use PDOStatement;

class PDODevboardStatement extends PDOStatement
{
    private $execTime = 0;
    private $params = [];

    public function getExecTime(): float
    {
        return $this->execTime;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function bindValue($parameter, $value, $data_type = PDO::PARAM_STR): bool
    {
        $this->params[$parameter] = $value;
        return parent::bindValue($parameter, $value, $data_type);
    }

    public function bindParam($parameter, &$variable, $data_type = PDO::PARAM_STR, $length = null, $driver_options = null): bool
    {
        $this->params[$parameter] = $variable;
        return parent::bindParam($parameter, $variable, $data_type, $length, $driver_options);
    }

    public function execute($input_parameters = null) : bool
    {
        $startTime = microtime(true);
        $isCorrectlyExecuted = parent::execute($input_parameters);
        $endTime = microtime(true);
        $this->execTime = round(($endTime - $startTime) * 1000, 2);
        return $isCorrectlyExecuted;
    }
}
