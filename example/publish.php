#!/usr/bin/php
<?php

require __DIR__ . '/../src/Publisher.php';
require __DIR__ . '/../src/Config.php';
require __DIR__ . '/../src/Storable.php';
require __DIR__ . '/../src/ArrayMessage/ArrayMessage.php';

$config = new \TimeCapsule\Config();

$publisher = new \TimeCapsule\Publisher();
$message = new \TimeCapsule\ArrayMessage\ArrayMessage([
    'randomValue' => rand()
]);

$embargoDate = new \DateTime();
$embargoDate->add(new \DateInterval('PT0S'));
$queueName = 'test';

$publisher->publishMessage($message, $embargoDate, $queueName);
