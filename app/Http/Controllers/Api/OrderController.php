<?php

namespace App\Http\Controllers\Api;

use App\Enums\DeliveryServiceEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CalculateRequest;
use App\Http\Requests\Order\CreateRequest;
use App\Models\Delivery;

class OrderController extends Controller
{
    public function calculate(CalculateRequest $request, DeliveryServiceEnum $deliveryService)
    {
        return response()->success([]); //TODO
    }

    public function create(CreateRequest $request, DeliveryServiceEnum $deliveryService)
    {
        return response()->success([]); //TODO
    }

    public function get(Delivery $delivery)
    {
        return response()->success(
            $delivery->present->toArray()
        ); //TODO
    }
}
