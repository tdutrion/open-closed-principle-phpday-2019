<?php

declare(strict_types=1);

namespace App\Demo;

interface DataProvider
{
    public function provideData(): array;
}
