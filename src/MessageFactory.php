<?php

namespace TimeCapsule;

interface MessageFactory
{
    public static function createFromString(string $rawString): Storable;

    public function __toString(): string;
}
