<?php

require_once __DIR__ . '/vendor/autoload.php';
use \Kafka\ConsumerConfig;
use \Kafka\Consumer;

$config = ConsumerConfig::getInstance();
$config->setMetadataBrokerList('kafka:9092');
$config->setGroupId($_ENV['SERVICE_ROLE']);
$config->setTopics(['logs']);
$consumer = new Consumer();
$connection = null;

while (true) {
    try {
        $consumer->start(function($topic, $part, $msg) {
            echo '*** Worker ' . $_ENV['SERVICE_ROLE'] . ' (' . $_ENV['HOSTNAME'] . ') ', $topic . ':' . $part . ' ', $topic, $msg['message']['value'], "\n";
        });
    } catch (Exception $exception) {
        // echo '*** Worker ' . $_ENV['SERVICE_ROLE'] . ' (' . $_ENV['HOSTNAME'] . ') Cannot connect: ', $exception->getMessage(), "\n";
        sleep(1);
    }
}


