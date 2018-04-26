<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = null;
// Wait for MQ service will be ready
while (null === $connection) {
    try {
        $connection = new AMQPStreamConnection('mq', 5672, 'guest', 'guest');
    } catch (Exception $exception) {
        sleep(1);
    }
}

$channel = $connection->channel();

$channel->exchange_declare('logs', 'fanout', false, false, false);

$queue_name = $_ENV['SERVICE_ROLE'] . 'queue';
$channel->queue_declare($queue_name, false, false, false, false);

$channel->queue_bind($queue_name, 'logs');

//echo '*** Worker ' . $_ENV['SERVICE_ROLE'] . ' (' . $_ENV['HOSTNAME'] . ') started and waiting for messages' . "\n";

$callback = function($msg){
    echo '*** Worker ' . $_ENV['SERVICE_ROLE'] . ' (' . $_ENV['HOSTNAME'] . ') ', $msg->body, "\n";
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();

