<?php

namespace App\Contracts;

interface EnumContract
{
    public static function allValues();

    public function equals(string $value): bool;

    public function notEquals(string $value): bool;
}
