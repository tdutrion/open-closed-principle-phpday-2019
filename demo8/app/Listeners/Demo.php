<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Demo
{
    public function handle($event)
    {
        dump($event);
    }
}
