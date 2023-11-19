<?php

namespace App\Services\Delivery\Deliveries\StatusProvider;

use App\API\Dostavista\DostavistaClientInterface;
use App\API\Dostavista\Requests\GetDeliveriesRequest;

class DostavistaStatusProvider extends BaseStatusProvider
{
    public function __construct(
        protected string $order_id
    )
    {}

    public function get(): array
    {
        $client = make(DostavistaClientInterface::class);

        $result = $client
            ->getOrders(
                new \App\API\Dostavista\Requests\GetOrdersRequest(
                    order_id: $this->order_id
                )
            );

        if (empty($result['orders'][0])) {
            return [];
        }

        $order = $result['orders'][0];

        $response['order'] = $order;

        if (! empty($order['points'][1]['delivery_id'])) {
            $delivery_id = $order['points'][1]['delivery_id'];

            $result = $client->getDeliveries(
                new GetDeliveriesRequest(
                    delivery_ids: [$delivery_id]
                )
            );

            if (! empty($delivery = $result['deliveries'][0])) {
                $response['delivery'] = $delivery;
            }
        }

        return $response;
    }
}
