<?php

namespace App\Http\Controllers\Api;

use App\Contracts\DeliveryServiceContract;
use App\Enums\DeliveryServiceEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CalculateRequest;
use App\Http\Requests\Order\CreateRequest;
use App\Services\Delivery\Deliveries\Calculator\BaseCalculator;
use App\Services\Delivery\Deliveries\Calculator\DostavistaCalculator;
use App\Services\Delivery\Deliveries\OrderMaker\BaseOrderMaker;
use App\Services\Delivery\Deliveries\OrderMaker\DostavistaOrderMaker;

class OrderController extends Controller
{
    public function calculate(CalculateRequest $request, DeliveryServiceEnum $deliveryService)
    {
        try {
            $calculator = match($deliveryService) {
                $deliveryService => make(DostavistaCalculator::class, $request->all())
            };

            $result = make(DeliveryServiceContract::class)
                ->calculate($calculator);

            return response()->success($result);
        } catch (\Exception $e) {
            report($e);

            return response()->fail();
        }
    }

    public function create(CreateRequest $request, DeliveryServiceEnum $deliveryService)
    {
        try {
            $orderMaker = match($deliveryService) {
                $deliveryService => make(DostavistaOrderMaker::class, $request->all())
            };

            $result = make(DeliveryServiceContract::class)
                ->create($orderMaker);

            return response()->success($result);
        } catch (\Exception $e) {
            report($e);

            return response()->fail();
        }
    }
}
