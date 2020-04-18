<?php

namespace App\HTTPRequest\Logger;

use App\Logger\BaseLogger;
use DateTime;

class HTTPLogger extends BaseLogger
{

    public function FormatLog(array $collectedData) : array
    {
        $time = new DateTime();
        $readableTime = $time->format('d M Y H:i:s');
        $formatedData = [];

        foreach($collectedData as $requestData) {
            if ($requestData !== null) {
                foreach ($requestData as $index => $value) {
                    $formatedData[] = "[ $readableTime ] $index: $value \n";
                }
            }
        }

        return $formatedData;
    }

    public function WriteLog(array $formatedData) : bool
    {

        foreach ($formatedData as $logline) {
            if (file_put_contents(__DIR__ . '/../../' . $_ENV['LOG_PATH_HTTP'] . '/http.log', $logline, FILE_APPEND | LOCK_EX) === false) {
                return false;
            }
        }
        return true;
    }

}