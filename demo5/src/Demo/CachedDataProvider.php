<?php

declare(strict_types=1);

namespace App\Demo;

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
