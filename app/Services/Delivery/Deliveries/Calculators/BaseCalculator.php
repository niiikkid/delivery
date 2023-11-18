<?php

namespace App\Services\Delivery\Deliveries\Calculators;

abstract class BaseCalculator
{
    abstract public function calc(): array;
}
