# monolog-zabbix


## Usage

```php
use xcezx\Monolog\Handler\ZabbixHandler;

$log = new Monolog\Logger('zbx');
$log->pushHandler(new ZabbixHandler('tcp://127.0.0.1:10051'), Logger::DEBUG);

$log->debug(1, array('host' => '127.0.0.1'));
$log->info('Lorem ipsum', array('host' => '127.0.0.1'));
```
