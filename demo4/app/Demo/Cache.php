<?php

declare(strict_types=1);

namespace App\Demo;

final class Cache
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
