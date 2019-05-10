<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Demo extends Command
{
    protected $signature = 'demo:demo';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        event(new \App\Events\Demo('event sent from demo:demo console'));
    }
}
