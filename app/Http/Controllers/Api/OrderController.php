<?php

namespace App\Http\Controllers\Api;

use App\Enums\DeliveryServiceEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CalculateRequest;

class OrderController extends Controller
{
    public function calculate(CalculateRequest $request, DeliveryServiceEnum $deliveryService)
    {
        return response()->success($request->all());
    }
}
