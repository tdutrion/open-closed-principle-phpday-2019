<?php

declare(strict_types=1);

namespace App\Demo;

final class InMemoryDataProvider implements DataProvider
{
    public function provideData(): array
    {
        $data = [];
        // does something
        return $data;
    }
}
