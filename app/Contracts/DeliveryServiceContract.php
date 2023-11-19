<?php

namespace App\Contracts;

use App\Enums\DeliveryServiceEnum;
use App\Services\Delivery\Deliveries\Calculator\BaseCalculator;
use App\Services\Delivery\Deliveries\OrderMaker\BaseOrderMaker;
use App\Services\Delivery\Deliveries\StatusProvider\BaseStatusProvider;
use App\Services\Delivery\Deliveries\Validation\BaseValidation;

interface DeliveryServiceContract
{
    public function calculate(BaseCalculator $calculator): array;

    public function create(BaseOrderMaker $baseOrderMaker): array;

    public function getStatus(BaseStatusProvider $statusProvider): array;

    public function getValidation(DeliveryServiceEnum $deliveryService): BaseValidation;
}
