<?php

namespace App\Services\Delivery\Deliveries\Calculator;

use App\Services\Delivery\Orders\DostavistaOrder;
use App\Services\Delivery\ValueObjects\DeliveryCalculatedValueObject;

abstract class BaseCalculator
{
    abstract public function calc(DostavistaOrder $order): DeliveryCalculatedValueObject;
}
