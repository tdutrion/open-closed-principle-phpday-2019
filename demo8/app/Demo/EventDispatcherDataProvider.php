<?php

declare(strict_types=1);

namespace App\Demo;

use Illuminate\Events\Dispatcher;

final class EventDispatcherDataProvider implements DataProvider
{
    private $dispatcher;
    private $dataProvider;
    public function __construct(Dispatcher $dispatcher, DataProvider $dataProvider)
    {
        $this->dispatcher = $dispatcher;
        $this->dataProvider = $dataProvider;
    }
    public function provideData(): array
    {
        $this->dispatcher->dispatch(new \App\Events\PreDataProvide());
        $data = $this->dataProvider->provideData();
        $this->dispatcher->dispatch(new \App\Events\PostDataProvide());

        return $data;
    }
}
