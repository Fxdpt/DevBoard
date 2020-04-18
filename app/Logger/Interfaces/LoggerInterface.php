<?php

namespace App\Logger\Interfaces;

interface LoggerInterface
{
    function FormatLog(array $collectedData);

    function WriteLog(array $formatedData);

    function addToLogFile(array $collectedData);
}