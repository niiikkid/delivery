<?php

namespace App\Services\Delivery\Deliveries\OrderMaker;

abstract class BaseOrderMaker
{
    abstract public function create(): array;
}
