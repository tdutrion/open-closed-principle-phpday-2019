<?php

declare(strict_types=1);

namespace App\Providers;

use App\Demo\Cache;
use App\Demo\CachedDataProvider;
use App\Demo\DataProvider;
use App\Demo\InMemoryDataProvider;
use App\Demo\LoggedDataProvider;
use App\Demo\Logger;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DataProviderProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $container = $this->app;
        $container->bind(DataProvider::class, InMemoryDataProvider::class);
        $container->bind(Logger::class, Logger::class);
        $container->bind(Cache::class, Cache::class);
        $container->extend(DataProvider::class, function (DataProvider $service) {
            return new CachedDataProvider($this->app->get(Cache::class), $service);
        });
        $container->extend(DataProvider::class, function (DataProvider $service) {
            return new LoggedDataProvider($this->app->get(Logger::class), $service);
        });
    }

    public function provides()
    {
        return [DataProvider::class];
    }
}
