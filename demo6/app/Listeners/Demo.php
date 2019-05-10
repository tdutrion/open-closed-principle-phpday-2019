<?php

namespace App\Listeners;

class Demo
{
    public function handle(\App\Events\Demo $event)
    {
        dd($event);
    }
}
