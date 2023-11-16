<?php

namespace App\API\Dostavista;

use App\API\Dostavista\Requests\CalculateOrderRequest;

interface DostavistaClientInterface
{
    public function calculateOrder(CalculateOrderRequest $request): array;
}
