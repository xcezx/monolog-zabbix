<?php
namespace xcezx\Monolog\Formatter;

use xcezx\Zabbix\Message;
use Monolog\Formatter\FormatterInterface;

class ZabbixFormatter implements FormatterInterface
{
    const PROTOCOL_HEADER  = 'ZBXD';
    const PROTOCOL_VERSION = 1;

    public function format(array $record)
    {
        $data = array(
            'request' => 'sender data',
            'data' => array(
                array(
                    'host' => $record['context']['host'],
                    'key' => $record['channel'] . '.' . strtolower($record['level_name']),
                    'value' => $record['message'],
                    'clock' => (int) $record['datetime']->format('U'),
                ),
            ),
        );

        $json_data = json_encode($data);
        $length = strlen($json_data);

        $message = pack(
            'a4CCCCCCCCCa*',
            self::PROTOCOL_HEADER,
            self::PROTOCOL_VERSION,
            ($length & 0xFF),
            ($length & 0x00FF) >> 8,
            ($length & 0x0000FF) >> 16,
            ($length & 0x000000FF) >> 24,
            0x00, 0x00, 0x00, 0x00,
            $json_data
        );

        return $message;
    }

    public function formatBatch(array $records)
    {
        var_dump($records);
    }
}
