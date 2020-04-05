<?php

use App\Database\Adapter\PDODevboardConnection;
use App\Database\Collector\PDOQueryCollector;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/../../../vendor/autoload.php';
$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../../.env.local');

$dbh = new PDODevboardConnection('localhost', 'musictourplanner', 'root', '');

$stmt = "SELECT * FROM band WHERE id < 50";
$query = $dbh->prepare($stmt);
$query->execute();

$id = 50;
$stmt = "SELECT * FROM band WHERE id < :id";
$query = $dbh->prepare($stmt);
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();

$place_id=122;
$stmt = "SELECT * FROM event WHERE id < :id AND place_id = :place_id";
$query = $dbh->prepare($stmt);
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->bindValue(':place_id', $place_id, PDO::PARAM_INT);
$query->execute();

$queryCollector = new PDOQueryCollector($dbh);

$queriesInfo = $queryCollector->getQueriesData();
