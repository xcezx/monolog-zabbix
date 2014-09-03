<?php
namespace xcezx\Monolog\Handler;

use Monolog\Logger;
use Monolog\Handler\SocketHandler;
use xcezx\Monolog\Formatter\ZabbixFormatter;

class ZabbixHandler extends SocketHandler
{
    public function __construct($connectionString, $level = Logger::DEBUG, $bubble = true)
    {
        $this->setFormatter(new ZabbixFormatter);
        parent::__construct($connectionString, $level, $bubble);
    }

    public function write(array $record)
    {
        parent::write($record);
        $this->close();
    }
}
