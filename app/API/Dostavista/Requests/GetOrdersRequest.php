<?php

namespace App\API\Dostavista\Requests;

class GetOrdersRequest extends Request
{
    protected $method = 'get';
    protected $uri = '/orders';

    public function __construct(
        public null | int | array $order_id = null,
        public ?string $status = null,
        public int $offset =  0,
        public int $count = 10,
    )
    {}
}
