<?php

namespace App\Logger\Interfaces;

interface LoggerInterface
{
    function FormatLog($collectedData);

    function WriteLog($formatedData);

    function addToLogFile($collectedData);
}