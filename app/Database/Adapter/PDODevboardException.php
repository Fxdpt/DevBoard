<?php

namespace App\Database\Adapter;

use PDOException;
use App\Database\Logger\PDOLogger;

class PDODevboardException extends PDOException
{
    private $logger;

    public function __construct(PDOException $e)
    {
        $errorInfo = [
            'code' => $e->getCode(),
            'message' => $e->getMessage(),
        ];

        $this->logger = new PDOLogger();
        $this->logger->addToLogFile($errorInfo);
    }
}