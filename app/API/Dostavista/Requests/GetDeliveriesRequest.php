<?php

namespace App\API\Dostavista\Requests;

class GetDeliveriesRequest extends Request
{
    protected $method = 'get';
    protected $uri = '/deliveries';

    public function __construct(
        public ?array $delivery_ids = null,
        public ?string $search_text = null,
        public ?string $status = null,
        public int $offset =  0,
        public int $count = 10,
    )
    {}
}
