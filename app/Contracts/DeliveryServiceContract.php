<?php

namespace App\Contracts;

use App\Enums\DeliveryServiceEnum;
use App\Services\Delivery\Deliveries\Calculators\BaseCalculator;
use App\Services\Delivery\Deliveries\Validation\BaseValidation;

interface DeliveryServiceContract
{
    public function calculate(BaseCalculator $calculator): array;

    public function getValidation(DeliveryServiceEnum $deliveryService): BaseValidation;
}
