<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Event;

final class Demo
{
    public function handle(Event $event): void
    {
        dump($event);
    }
}
