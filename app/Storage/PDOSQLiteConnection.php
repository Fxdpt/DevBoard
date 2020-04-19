<?php

namespace App\Storage;

use App\Database\Adapter\PDODevboardException;
use PDO;
use PDOException;

class PDOSQLiteConnection
{
    private static $_instance;
    private $connection = null;

    public function __construct()
    {
        try {
            $dsn = "sqlite:".__DIR__."/datastorage.sqlite";
            $this->connection = new PDO($dsn);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        } catch (PDOException $e) {
            throw new PDODevboardException($e);
        }
    }

    public static function getPDO(){
        if (empty(self::$_instance)) {
            self::$_instance = new PDOSQLiteConnection();
        }
        return self::$_instance->connection;
    }

}