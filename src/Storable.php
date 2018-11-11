<?php

namespace TimeCapsule;

interface Storable
{
    public static function createFromString(string $rawString): self;

    public function __toString(): string;
}
