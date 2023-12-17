<?php

namespace App\Services\Delivery\Deliveries\OrderMaker;

use App\Models\Delivery;
use App\Services\Delivery\Orders\DostavistaOrder;

abstract class BaseOrderMaker
{
    abstract public function create(DostavistaOrder $order): Delivery;
}
