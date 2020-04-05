<?php

namespace App\Database\Interfaces;

interface LoggerInterface
{
    function FormatLog(array $collectedData);

    function WriteLog(array $formatedData);

    function addToLogFile(array $collectedData);
}