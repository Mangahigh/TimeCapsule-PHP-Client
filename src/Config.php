<?php

namespace TimeCapsule;

class Config
{
    const DEFAULT_QUEUE_NAME = 'default';

    // --

    /**
     * The host name that the TimeCapsule server is running on
     * @var string
     */
    private $host = '127.0.0.1';

    /**
     * The port that the TimeCapsule server is running on
     * @var integer
     */
    private $port = 1777;

    /**
     * The timeout for sending message in milliseconds
     * @var integer
     */
    private $timeout = 100;

    // --

    public function setHost(string $host)
    {
        $this->host = $host;
    }

    public function setPort(int $port)
    {
        $this->port = $port;
    }

    // --

    public function getPort(): int
    {
        return $this->port;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    // --

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;
    }
}
