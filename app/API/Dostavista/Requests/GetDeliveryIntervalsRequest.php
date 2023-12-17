<?php

namespace App\API\Dostavista\Requests;

class GetDeliveryIntervalsRequest extends Request
{
    protected $method = 'get';
    protected $uri = '/delivery-intervals';

    public function __construct(
        public ?string $date = null
    )
    {}
}
