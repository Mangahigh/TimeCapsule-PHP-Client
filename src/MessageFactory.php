<?php

namespace TimeCapsule;

interface MessageFactory
{
    public static function createFromString(string $rawString): Storable;
}
