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

    // --

    /**
     * @param string $host
     */
    public function setHost(string $host)
    {
        $this->host = $host;
    }

    /**
     * @param integer $port
     */
    public function setPort(int $port)
    {
        $this->port = $port;
    }

    // --

    /**
     * @return integer
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }


}
