<?php

declare(strict_types=1);

namespace App\Events;

class Demo
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
