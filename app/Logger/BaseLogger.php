<?php

namespace App\Logger;

use App\Logger\Interfaces\LoggerInterface;

class BaseLogger implements LoggerInterface
{

    public function FormatLog($collectedData)
    {

    }

    public function WriteLog($formatedData)
    {

    }

    /**
     * Method call by the Collector to gather data and wrote it
     *
     * @param array $collectedData
     * @return boolean
     */
    public function addToLogFile($collectedData): bool
    {
        $formattedLog = $this->formatLog($collectedData);
        $logIsWrited = $this->WriteLog($formattedLog);

        if ($logIsWrited === false) {
            return $logIsWrited;
        }

        return true;
    }
}