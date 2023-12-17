<?php

namespace App\Http\Controllers\Api;

use App\Contracts\DeliveryServiceContract;
use App\Enums\DeliveryServiceEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CalculateRequest;
use App\Http\Requests\Order\CreateRequest;
use App\Services\Delivery\Deliveries\Calculator\DostavistaCalculator;
use App\Services\Delivery\Deliveries\OrderMaker\DostavistaOrderMaker;
use App\Services\Delivery\Deliveries\StatusProvider\DostavistaStatusProvider;

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

    public function get(DeliveryServiceEnum $deliveryService, string $order_id)
    {
        try {
            $statusProvider = match($deliveryService) {
                $deliveryService => make(DostavistaStatusProvider::class, [
                    'order_id' => $order_id
                ])
            };

            $result = make(DeliveryServiceContract::class)
                ->getStatus($statusProvider);

            return response()->success($result);
        } catch (\Exception $e) {
            report($e);

            return response()->fail();
        }
    }
}
