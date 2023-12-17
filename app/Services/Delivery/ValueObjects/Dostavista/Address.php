<?php

namespace App\Services\Delivery\ValueObjects\Dostavista;

use Carbon\Carbon;

class Address
{
    public function __construct(
        public string $address,
        public string $phone,
        public ?string $entrance_number = null,
        public ?string $floor_number = null,
        public ?string $apartment_number = null,
        public ?string $invisible_mile_navigation_instructions = null,
        public ?Carbon $required_start_datetime = null,
        public ?Carbon $required_finish_datetime = null,
        public ?string $note = null,
    )
    {}
}
