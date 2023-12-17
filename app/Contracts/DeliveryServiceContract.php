<?php

namespace App\Contracts;

use App\Enums\DeliveryServiceEnum;
use App\Models\Delivery;
use App\Services\Delivery\Orders\BaseOrder;
use App\Services\Delivery\ValueObjects\DeliveryCalculatedValueObject;
use Illuminate\Http\Request;

interface DeliveryServiceContract
{
    public function calculate(BaseOrder $order): DeliveryCalculatedValueObject;

    public function create(BaseOrder $order): Delivery;

    public function handleCallback(Request $request, DeliveryServiceEnum $deliveryService): void;
}
