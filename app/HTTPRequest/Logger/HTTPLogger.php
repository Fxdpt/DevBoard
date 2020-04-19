<?php

namespace App\HTTPRequest\Logger;

use App\Logger\BaseLogger;
use DateTime;

class HTTPLogger extends BaseLogger
{

    public function FormatLog($collectedData): string
    {
        $time = new DateTime();
        $readableTime = $time->format('d M Y H:i:s');
        $logLine = "[$readableTime] {$collectedData['client_ip']} [{$collectedData['status']}] {$collectedData['method']} {$collectedData['uri']}";

        return $logLine;
    }

    public function WriteLog($logLine): bool
    {
        if (file_put_contents(__DIR__ . '/../../' . $_ENV['LOG_PATH_HTTP'] . '/http.log', $logLine, FILE_APPEND | LOCK_EX) === false) {
            return false;
        }

        return true;
    }
}
