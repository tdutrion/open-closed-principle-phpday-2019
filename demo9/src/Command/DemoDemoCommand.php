<?php

namespace App\Command;

use App\Demo\DataProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DemoDemoCommand extends Command
{
    protected static $defaultName = 'demo:demo';
    private $dataProvider;

    public function __construct(DataProvider $dataProvider)
    {
        parent::__construct(self::$defaultName);
        $this->dataProvider = $dataProvider;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->dataProvider->provideData();
    }
}
