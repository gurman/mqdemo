<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('mq', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('logs', 'fanout', false, false, false);

$time = date('H:i:s');
$msg = new AMQPMessage('Index page was visited at ' . $time);

$channel->basic_publish($msg, 'logs');

echo '<h1>Index page</h1>Message sent, check consumers logs.<br>Time: ' . $time;

$channel->close();
$connection->close();

