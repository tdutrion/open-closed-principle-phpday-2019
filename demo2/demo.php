<?php

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
    public function has(string $key): bool
    {
        return false;
    }
    
    public function get(string $key)
    {
        // does something probably, and returns for sure!
    }
    
    public function set(string $key, $value): void
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

class CachedDataProvider implements DataProvider
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

$cache = new Cache();
$logger = new Logger();
$dataProvider = new InMemoryDataProvider();

$cachedLoggedDataProvider = new CachedDataProvider(
    $cache,
    new LoggedDataProvider($logger, $dataProvider)
);
$cachedLoggedDataProvider->provideData();
$loggedCachedDataProvider = new LoggedDataProvider(
    $logger,
    new CachedDataProvider($cache, $dataProvider)
);
$loggedCachedDataProvider->provideData();
