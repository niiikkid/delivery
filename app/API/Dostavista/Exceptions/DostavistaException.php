<?php

namespace App\API\Dostavista\Exceptions;

class DostavistaException extends \Exception
{
    public static function make(array $context): static
    {
        $context_string = json_encode($context);

        return new static("Dostavista - Exception context: $context_string");
    }
}
