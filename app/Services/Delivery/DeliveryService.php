<?php

namespace App\Services\Delivery;

use App\Contracts\DeliveryServiceContract;
use App\Enums\DeliveryServiceEnum;
use App\Services\Delivery\Deliveries\Calculator\BaseCalculator;
use App\Services\Delivery\Deliveries\OrderMaker\BaseOrderMaker;
use App\Services\Delivery\Deliveries\Validation\BaseValidation;

class DeliveryService implements DeliveryServiceContract
{
    public function calculate(BaseCalculator $calculator): array
    {
        return $calculator->calc();
    }

    public function create(BaseOrderMaker $baseOrderMaker): array
    {
        return $baseOrderMaker->create();
    }

    public function getValidation(DeliveryServiceEnum $deliveryService): BaseValidation
    {
        $class_name = ucfirst($deliveryService->value) . 'Validation';
        return make(__NAMESPACE__.'\\Deliveries\\Validation\\' . $class_name);
    }
}
