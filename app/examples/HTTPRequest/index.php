<?php

use Symfony\Component\Dotenv\Dotenv;
use App\HTTPRequest\Collector\HTTPCollector;

require '../../../vendor/autoload.php';
$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../../.env.local');

$collector = new HTTPCollector;

$collector->getAllRequestData();
