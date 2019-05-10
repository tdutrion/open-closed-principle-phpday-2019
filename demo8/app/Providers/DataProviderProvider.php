<?php

declare(strict_types=1);

namespace App\Providers;

use App\Demo\DataProvider;
use App\Demo\EventDispatcherDataProvider;
use App\Demo\InMemoryDataProvider;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DataProviderProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $container = $this->app;
        $container->bind(DataProvider::class, InMemoryDataProvider::class);
        $container->extend(DataProvider::class, function (DataProvider $service) {
            return new EventDispatcherDataProvider($this->app->get(Dispatcher::class), $service);
        });
    }

    public function provides()
    {
        return [DataProvider::class];
    }
}
