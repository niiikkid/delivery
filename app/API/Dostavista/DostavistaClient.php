<?php

namespace App\API\Dostavista;

use App\API\Dostavista\Requests\CalculateOrderRequest;
use App\API\Dostavista\Requests\CreateOrderRequest;
use App\API\Dostavista\Requests\GetDeliveriesRequest;
use App\API\Dostavista\Requests\GetOrdersRequest;
use App\API\Dostavista\Requests\Request;

class DostavistaClient implements DostavistaClientInterface
{
    private Http $http;

    public function __construct(
        string $token
    )
    {
        $this->http = new Http($token);
    }

    public function calculateOrder(CalculateOrderRequest $request): array
    {
        return $this->doRequest($request);
    }

    public function createOrder(CreateOrderRequest $request): array
    {
        return $this->doRequest($request);
    }

    public function getOrders(GetOrdersRequest $request): array
    {
        return $this->doRequest($request);
    }

    public function getDeliveries(GetDeliveriesRequest $request): array
    {
        return $this->doRequest($request);
    }

    protected function doRequest(Request $request): array
    {
        return $this->http->request(
            $request->getMethod(),
            $request->getUri(),
            $this->prepareParams($request),
        );
    }

    protected function prepareParams(Request $request): array
    {
        return array_filter_recursive(
            $this->requestToArray($request),
            fn ($i) => $i !== null && $i !== ''
        );
    }

    protected function requestToArray(object | array $data)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        foreach ($data as &$value) {
            if (is_object($value)) {
                $value = $this->requestToArray($value);
            }
            if (is_array($value)) {
                $value = $this->requestToArray($value);
            }
        }

        return $data;
    }
}
