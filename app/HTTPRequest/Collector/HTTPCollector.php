<?php

namespace App\HTTPRequest\Collector;

use App\HTTPRequest\Logger\HTTPLogger;

class HTTPCollector
{
    private $httpRequest;
    private $cookies;
    private $request;

    public function __construct()
    {
        $this->httpRequest = $_SERVER;
        $this->cookie = $_COOKIE;
        $this->request = $_REQUEST;
    }

    public function getHttpRequest() : array
    {
        return $this->httpRequest;
    }

    public function getCookies() : ?array
    {
        return $this->cookies;
    }

    public function getRequest() : array
    {
        return $this->request;
    }

    public function getAllRequestData() : array
    {
        $requestData = [
            'HTTP Request' => $this->httpRequest,
            'Cookies' => $this->cookies,
            'Request params' => $this->request
        ];

        $logger = new HTTPLogger();
        $logger->addToLogFile($requestData);

        return $requestData;
    }
}