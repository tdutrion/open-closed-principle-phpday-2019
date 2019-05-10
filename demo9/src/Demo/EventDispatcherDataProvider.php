<?php

declare(strict_types=1);

namespace App\Demo;
use App\Event\PostDataProvider;
use App\Event\PreDataProvider;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class EventDispatcherDataProvider implements DataProvider
{
    private $eventDispatcher;
    private $dataProvider;

    public function __construct(EventDispatcherInterface $eventDispatcher,  DataProvider $dataProvider)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->dataProvider = $dataProvider;
    }

    public function provideData(): array
    {
        $this->eventDispatcher->dispatch(PreDataProvider::class, new PreDataProvider());
        $data = $this->dataProvider->provideData();
        $this->eventDispatcher->dispatch(PostDataProvider::class, new PostDataProvider());

        return $data;
    }
}
