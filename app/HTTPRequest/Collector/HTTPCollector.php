<?php

namespace App\HTTPRequest\Collector;

use App\HTTPRequest\Logger\HTTPLogger;

class HTTPCollector
{
    private $logger;

    public function __construct()
    {
        $this->logger = new HTTPLogger();
    }

    public function getAllRequestData() : array
    {
        $clientIp = $_SERVER['REMOTE_ADDR'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $statusCode = http_response_code();

        $requestData = [
            'client_ip' => $clientIp,
            'method' => $requestMethod,
            'uri' => $requestUri,
            'status' => $statusCode,
        ];

        $this->logger->addToLogFile($requestData);
        return $requestData;
    }
}