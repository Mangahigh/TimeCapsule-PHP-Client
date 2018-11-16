#!/usr/bin/php
<?php

require __DIR__ . '/../src/Subscriber.php';
require __DIR__ . '/../src/Config.php';
require __DIR__ . '/../src/Storable.php';
require __DIR__ . '/../src/ArrayMessage/ArrayMessage.php';
require __DIR__ . '/../src/ArrayMessage/ArrayMessageFactory.php';

$config = new \TimeCapsule\Config();

$subscriber = new \TimeCapsule\Subscriber($config);
$queueName = 'test';

$message = $subscriber->fetchMessage($queueName);

var_dump($message->getDataArray());

$subscriber->ackMessage($message);
