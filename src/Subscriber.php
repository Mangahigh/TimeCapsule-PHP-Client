<?php

namespace TimeCapsule;

use TimeCapsule\ArrayMessage\ArrayMessageFactory;

class Subscriber
{
    /**
     * @var \TimeCapsule\Config
     */
    private $config;

    private $openSockets = [];

    // ---

    public function __construct(Config $config = null)
    {
        $this->config = $config ?: new Config();
    }

    public function fetchMessage(string $queueName = Config::DEFAULT_QUEUE_NAME, MessageFactory $messageFactory = null): Storable
    {
        if (!$messageFactory) {
            $messageFactory = new ArrayMessageFactory();
        }

        $timeCapsuleConnectionSocket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_connect($timeCapsuleConnectionSocket, $this->config->getHost(), $this->config->getPort());

        if (socket_read($timeCapsuleConnectionSocket, 2) !== 'OK') {
            throw new Exception\FailedToConnect();
        }

        $command = [
            'FETCH',
            $queueName
        ];

        $commandString = implode(' ', $command);
        socket_write($timeCapsuleConnectionSocket, $commandString);

        if (socket_read($timeCapsuleConnectionSocket, 2) !== 'OK') {
            throw new Exception\FailedToSendCommand();
        }

        $data = socket_read($timeCapsuleConnectionSocket, 65536);

        if (!$data) {
            throw new Exception\FailedToFetchMessage();
        }

        $message = $messageFactory::createFromString($data);

        $this->openSockets[serialize($message)] = $timeCapsuleConnectionSocket;

        return $message;
    }

    public function ackMessage(Storable $message)
    {
        $timeCapsuleConnectionSocket = $this->openSockets[serialize($message)];

        // TODO - error handling;

        socket_write($timeCapsuleConnectionSocket, 'ACK');
        socket_close($timeCapsuleConnectionSocket);

        unset($this->openSockets[serialize($message)]);
    }
}
