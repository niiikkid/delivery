<?php

namespace App\Services\Delivery\Deliveries\StatusProvider;

abstract class BaseStatusProvider
{
    abstract public function get(): array;
}
