<?php

namespace App\API\Dostavista\Requests;

class CalculateOrderRequest extends Request
{
    protected $method = 'post';
    protected $uri = '/calculate-order';

    public function __construct(
        public string $type,
        public ?string $matter,
        public int $vehicle_type_id,
        public int $total_weight_kg,
        public ?string $payment_method,
        public array $points,
    )
    {}
}
