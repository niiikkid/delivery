<?php

namespace App\API\Dostavista;

use App\API\Dostavista\Requests\CalculateOrderRequest;
use App\API\Dostavista\Requests\CreateOrderRequest;
use App\API\Dostavista\Requests\GetDeliveriesRequest;
use App\API\Dostavista\Requests\GetDeliveryIntervalsRequest;
use App\API\Dostavista\Requests\GetOrdersRequest;
use Illuminate\Http\Request;

interface DostavistaClientInterface
{
    public function calculateOrder(CalculateOrderRequest $request): array;

    public function createOrder(CreateOrderRequest $request): array;

    public function getOrders(GetOrdersRequest $request): array;

    public function getDeliveries(GetDeliveriesRequest $request): array;

    public function getDeliveryIntervals(GetDeliveryIntervalsRequest $request): array;

    public function handleCallback(Request $request): array;
}
