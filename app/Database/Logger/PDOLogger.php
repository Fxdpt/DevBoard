<?php

namespace App\Database\Logger;

use App\Database\Interfaces\LoggerInterface;
use DateTime;

class PDOLogger implements LoggerInterface
{
    /**
     * Format the incoming array as a string
     *
     * @param array $collectedData
     * @return array
     */
    public function formatLog(array $collectedData): array
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
    public function WriteLog(array $log) : bool
    {
        foreach ($log as $logline) {
            if (file_put_contents(__DIR__ . '/../../' . $_ENV['LOG_PATH_PDO'] . '/pdo.log', $logline, FILE_APPEND | LOCK_EX) === false) {
                return false;
            }
        }
        return true;
    }

    /**
     * Method call by the Collector to gather data and wrote it
     *
     * @param array $collectedData
     * @return boolean
     */
    public function addToLogFile(array $collectedData): bool
    {
        $formattedLog = $this->formatLog($collectedData);
        $logIsWrited = $this->WriteLog($formattedLog);

        if ($logIsWrited === false) {
            return $logIsWrited;
        }

        return true;
    }
}
