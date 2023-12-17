<?php

namespace App\ValueObjects;

class DeliverySimpleValueObject extends BaseValueObject
{
    public function __construct(
        public string  $status,
        public ?string $sub_status,
    )
    {}
}
