<?php

namespace TimeCapsule\ArrayMessage;

use TimeCapsule\Storable;

class ArrayMessage implements Storable
{
    /**
     * The data of the message
     * @var array
     */
    private $dataArray;

    // ---

    public function __construct(array $dataArray = [])
    {
        $this->dataArray = $dataArray;
    }

    public function getDataArray(): array
    {
        return $this->dataArray;
    }

    public static function createFromString(string $rawString): Storable
    {
        $dataArray = json_decode($rawString, true);
        return new self($dataArray);
    }

    public function __toString(): string
    {
        return json_encode($this->dataArray);
    }
}
