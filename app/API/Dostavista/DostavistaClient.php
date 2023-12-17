<?php

namespace App\API\Dostavista;

use App\API\Dostavista\Requests\CalculateOrderRequest;
use App\API\Dostavista\Requests\CreateOrderRequest;
use App\API\Dostavista\Requests\GetDeliveriesRequest;
use App\API\Dostavista\Requests\GetDeliveryIntervalsRequest;
use App\API\Dostavista\Requests\GetOrdersRequest;
use App\API\Dostavista\Requests\Request;

class DostavistaClient implements DostavistaClientInterface
{
    private Http $http;

    public function __construct(
        string $token,
        private string $callback_token,
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
        return $this->doRequest($request)['order'];
    }

    public function getOrders(GetOrdersRequest $request): array
    {
        return $this->doRequest($request);
    }

    public function getDeliveries(GetDeliveriesRequest $request): array
    {
        return $this->doRequest($request);
    }

    public function getDeliveryIntervals(GetDeliveryIntervalsRequest $request): array
    {
        return $this->doRequest($request);
    }

    public function handleCallback(\Illuminate\Http\Request $request): array
    {
        $request_signature = $request->header('x-dv-signature');
        if (! $request_signature) {
            abort(400, 'Error: Signature not found');
        }

        $signature = hash_hmac('sha256', $request->getContent(), $this->callback_token);
        if ($signature !== $request_signature) {
            abort(400, 'Error: Signature is not valid');
        }

        return $request->all();
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
