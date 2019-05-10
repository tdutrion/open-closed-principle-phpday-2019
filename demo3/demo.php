<?php
require __DIR__.'/vendor/autoload.php';
class Logger
{
    public function log($level, $message, $context = [])
    {
        // this should do something... or not!
        echo "$message\n";
    }
}

class Cache
{
    public function has($key): bool
    {
        return false;
    }
    
    public function get($key, $default = null)
    {
        // does something probably, and returns for sure!
    }
    
    public function set($key, $value, $ttl = null): void
    {
        // let's do it!
    }
}

final class LoggedDataProvider implements DataProvider
{
    private $logger;
    private $provider;
    public function __construct(
        Logger $logger,
        DataProvider $provider
    ) {
        $this->logger = $logger;
        $this->provider = $provider;
    }
    public function provideData(): array
    {
       $this->logger->log('debug', 'provide_data.before');
       $data = $this->provider->provideData();
       $this->logger->log('debug', 'provide_data.after');
       
       return $data;
    }
}

final class CachedDataProvider implements DataProvider
{
    private $cache;
    private $provider;
    public function __construct(
        Cache $cache,
        DataProvider $provider
    ) {
        $this->cache = $cache;
        $this->provider = $provider;
    }
    public function provideData(): array
    {
       if ($this->cache->has('my_data')) {
            return $this->cache->get('my_data');
       }
       $data = $this->provider->provideData();
       $this->cache->set('my_data', $data);
       return $data;
    }
}

interface DataProvider
{
   public function provideData(): array;
}

final class InMemoryDataProvider implements DataProvider
{
     public function provideData(): array
     {
         $data = [];
         // does something
         return $data;
     }
}

$container = new Illuminate\Container\Container;
$container->bind(DataProvider::class, InMemoryDataProvider::class);
$container->bind(Logger::class, Logger::class);
$container->bind(Cache::class, Cache::class);
$container->extend(DataProvider::class, function (DataProvider $service) use ($container) {

    return new CachedDataProvider($container->get(Cache::class), $service);
});
$container->extend(DataProvider::class, function (DataProvider $service) use ($container) {

    return new LoggedDataProvider($container->get(Logger::class), $service);
});
var_dump($container->get(DataProvider::class));
