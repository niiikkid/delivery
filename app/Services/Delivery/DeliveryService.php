<?php

namespace App\Services\Delivery;

use App\Contracts\DeliveryServiceContract;
use App\Enums\DeliveryServiceEnum;
use App\Services\Delivery\Deliveries\Calculators\BaseCalculator;
use App\Services\Delivery\Deliveries\Validation\BaseValidation;

class DeliveryService implements DeliveryServiceContract
{
    public function calculate(BaseCalculator $calculator): array
    {
        return $calculator->calc();
    }

    public function getValidation(DeliveryServiceEnum $deliveryService): BaseValidation
    {
        $class_name = ucfirst($deliveryService->value) . 'Validation';
        return make(__NAMESPACE__.'\\Deliveries\\Validation\\' . $class_name);
    }
}
