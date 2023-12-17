<?php

namespace App\Services\Delivery;

use App\Contracts\DeliveryServiceContract;
use App\Enums\DeliveryServiceEnum;
use App\Models\Delivery;
use App\Services\Delivery\Deliveries\Calculator\BaseCalculator;
use App\Services\Delivery\Deliveries\CallbackHandler\BaseCallbackHandler;
use App\Services\Delivery\Deliveries\OrderMaker\BaseOrderMaker;
use App\Services\Delivery\Orders\BaseOrder;
use App\Services\Delivery\ValueObjects\DeliveryCalculatedValueObject;
use Illuminate\Http\Request;

class DeliveryService implements DeliveryServiceContract
{
    public function calculate(BaseOrder $order): DeliveryCalculatedValueObject
    {
        $class_name = ucfirst($order->deliveryService()->value) . 'Calculator';
        /**
         * @var BaseCalculator $calculator
         */
        $calculator = make(__NAMESPACE__.'\\Deliveries\\Calculator\\' . $class_name);

        return $calculator->calc($order);
    }

    public function create(BaseOrder $order): Delivery
    {
        $class_name = ucfirst($order->deliveryService()->value) . 'OrderMaker';
        /**
         * @var BaseOrderMaker $orderMaker
         */
        $orderMaker = make(__NAMESPACE__.'\\Deliveries\\OrderMaker\\' . $class_name);

        return $orderMaker->create($order);
    }

    public function handleCallback(Request $request, DeliveryServiceEnum $deliveryService): void
    {
        $class_name = ucfirst($deliveryService->value) . 'CallbackHandler';
        /**
         * @var BaseCallbackHandler $handler
         */
        $handler = make(__NAMESPACE__.'\\Deliveries\\CallbackHandler\\' . $class_name);

        $handler->handle($request);
    }
}
