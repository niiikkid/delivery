<?php

namespace App\Http\Controllers\Api;

use App\Contracts\DeliveryServiceContract;
use App\Enums\DeliveryServiceEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CalculateRequest;
use App\Services\Delivery\Deliveries\Calculators\BaseCalculator;
use App\Services\Delivery\Deliveries\Calculators\DostavistaCalculator;

class OrderController extends Controller
{
    public function calculate(CalculateRequest $request, DeliveryServiceEnum $deliveryService)
    {
        try {
            /**
             * @var BaseCalculator $calculator
             */
            $calculator = match($deliveryService) {
                $deliveryService => DostavistaCalculator::makeFormRequest($request)
            };

            $result = make(DeliveryServiceContract::class)
                ->calculate($calculator);

            return response()->success($result);
        } catch (\Exception $e) {
            report($e);

            return response()->fail();
        }
    }
}
