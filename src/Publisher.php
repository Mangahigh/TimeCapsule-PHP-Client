<?php

namespace TimeCapsule;

class Publisher
{
    /**
     * @var \TimeCapsule\Config
     */
    private $config;

    // ---

    /**
     * Create a TimeCapsule publisher
     *
     * @param \TimeCapsule\Config $config An optional configuration parameter
     */
    public function __construct(Config $config = null)
    {
        $this->config = $config ?: new Config();
    }

    /**
     * Stores a message in TimeCapsule until a specified date
     *
     * @param \TimeCapsule\Storable $message
     * @param \DateTime             $embargoDate
     * @param string                $queueName
     *
     * @throws \TimeCapsule\Exception\FailedToConnect
     * @throws \TimeCapsule\Exception\FailedToSendCommand
     * @throws \TimeCapsule\Exception\FailedToStoreMessage
     *
     * @return boolean
     */
    public function publishMessage(Storable $message, \DateTime $embargoDate, string $queueName = Config::DEFAULT_QUEUE_NAME)
    {
        $timeCapsuleConnectionSocket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_connect(
            $timeCapsuleConnectionSocket,
            $this->config->getHost(),
            $this->config->getPort()
        );

        if (socket_read($timeCapsuleConnectionSocket, 2) !== 'OK') {
            throw new Exception\FailedToConnect();
        }

        // ---

        $command = [
            'STORE',
            $queueName,
            $embargoDate->format('c')
        ];

        $commandString = implode(' ', $command);

        socket_write($timeCapsuleConnectionSocket, $commandString);

        // ---

        if (socket_read($timeCapsuleConnectionSocket, 2) !== 'OK') {
            throw new Exception\FailedToSendCommand();
        }

        socket_write($timeCapsuleConnectionSocket, (string) $message);


        if (socket_read($timeCapsuleConnectionSocket, 2) !== 'OK') {
            throw new Exception\FailedToStoreMessage();
        }

        socket_close($timeCapsuleConnectionSocket);

        return true;
    }
}
