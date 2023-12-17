<?php

namespace App\Services\Delivery\Orders;

use App\Enums\DeliveryServiceEnum;

abstract class BaseOrder
{
    abstract public function deliveryService(): DeliveryServiceEnum;
}
