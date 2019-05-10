<?php

declare(strict_types=1);

namespace App\Demo;

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
