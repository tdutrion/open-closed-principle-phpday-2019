<?php

namespace App\Providers;

use App\Events\PostDataProvide;
use App\Events\PreDataProvide;
use App\Listeners\Demo;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PreDataProvide::class => [
            Demo::class,
        ],
        PostDataProvide::class => [
            Demo::class,
        ],
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}
