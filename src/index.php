<?php

require_once __DIR__ . '/vendor/autoload.php';
use \Kafka\ProducerConfig;
use \Kafka\Producer;

$config = ProducerConfig::getInstance();
$config->setMetadataBrokerList('kafka:9092');
$producer = new Producer();

$time = date('H:i:s');
$producer->send([
    [
        'topic' => 'logs',
        'value' => 'Index page was visited at ' . $time,
    ],
]);

echo '<h1>Index page</h1>Message sent, check consumers logs.<br>Time: ' . $time;
