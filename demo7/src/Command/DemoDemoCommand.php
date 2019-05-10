<?php

namespace App\Command;

use App\Event\Demo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DemoDemoCommand extends Command
{
    protected static $defaultName = 'demo:demo';
    private $eventDispatcher;
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct(self::$defaultName);
        $this->eventDispatcher = $eventDispatcher;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->eventDispatcher->dispatch(Demo::class, new Demo('event sent from demo:demo console'));
    }
}
