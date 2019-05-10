<?php

declare(strict_types=1);

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

class Demo extends Event
{
    private $message;
    private $details;
    public function __construct(string $message, array $details = [])
    {
        $this->message = $message;
        $this->details = $details;
    }
    public function getMessage(): string
    {
        return $this->message;
    }
    public function getDetails(): array
    {
        return $this->details;
    }
}
