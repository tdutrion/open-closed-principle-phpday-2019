<?php

declare(strict_types=1);

namespace App\Demo;

class Logger
{
    public function log($level, $message, $context = [])
    {
        // this should do something... or not!
        echo "$message\n";
    }
}
