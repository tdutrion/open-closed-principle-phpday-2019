<?php

class DataProvider
{
     public function provideData(): array
     {
         $data = [];
         // does something
         return $data;
     }
}

class Logger
{
    public function log($level, $message, $context = [])
    {
        // this should do something... or not!
        echo "$message\n";
    }
}

class LoggedDataProvider extends DataProvider
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function provideData(): array
    {
       $this->logger->log('debug', 'provide_data.before');
       $data = parent::provideData();
       $this->logger->log('debug', 'provide_data.after');

       return $data;
    }
}

$dataProvider = new LoggedDataProvider(new Logger());
$dataProvider->provideData();
