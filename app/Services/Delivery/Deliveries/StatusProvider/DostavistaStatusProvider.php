<?php

namespace App\Services\Delivery\Deliveries\StatusProvider;

use App\API\Dostavista\DostavistaClientInterface;

class DostavistaStatusProvider extends BaseStatusProvider
{
    public function __construct(
        protected string $order_id
    )
    {}

    public function get(): array
    {
        $result = make(DostavistaClientInterface::class)
            ->getOrders(
                new \App\API\Dostavista\Requests\GetOrdersRequest(
                    order_id: $this->order_id
                )
            );

        return $result['orders'][0] ?? [];
    }
}
