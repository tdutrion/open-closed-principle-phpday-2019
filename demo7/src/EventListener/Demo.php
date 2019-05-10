<?php

declare(strict_types=1);

namespace App\EventListener;

class Demo
{
    public function handle(\App\Event\Demo $event)
    {
        dd($event);
    }
}
