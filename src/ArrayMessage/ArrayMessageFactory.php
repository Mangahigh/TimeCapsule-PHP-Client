<?php

namespace TimeCapsule\ArrayMessage;

use TimeCapsule\Storable;

class ArrayMessageFactory
{
    public static function createFromString(string $rawString): Storable
    {
        return ArrayMessage::createFromString($rawString);
    }
}
