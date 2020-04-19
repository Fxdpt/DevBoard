<?php

namespace App\Database\Logger;

use App\Logger\BaseLogger;
use DateTime;

class PDOLogger extends BaseLogger
{
    /**
     * Format the incoming array as a string
     *
     * @param array $collectedData
     * @return array
     */
    public function formatLog($collectedData): array
    {
        $time = new DateTime();
        $readableTime = $time->format('d M Y H:i:s');
        $formatedData = [];

        foreach ($collectedData as $queryInfo) {
            $queryData = '';
            if (gettype($queryInfo) === "array") {
                foreach ($queryInfo as $index => $params) {
                    if($index === 'duration') {
                        $queryData .= "$params ms - ";
                    }elseif (gettype($params) == 'array') {
                        foreach ($params as $bindedParam => $value) {
                            $queryData .= "$bindedParam : $value - ";
                        }
                    } else {
                        $queryData .= "$params - ";
                    }
                }
                $formatedData[] = "[ $readableTime ] DBRequest: $queryData \n";
            } else {
                $queryData .= "$queryInfo";
                $formatedData[] = "[ $readableTime ] Exception: $queryData \n";
            }
        }
        return $formatedData;
    }

    /**
     * Write the log into a logfile
     *
     * @param array $log
     * @return bool
     */
    public function WriteLog($log) : bool
    {
        foreach ($log as $logline) {
            if (file_put_contents(__DIR__ . '/../../' . $_ENV['LOG_PATH_PDO'] . '/pdo.log', $logline, FILE_APPEND | LOCK_EX) === false) {
                return false;
            }
        }
        return true;
    }
}
