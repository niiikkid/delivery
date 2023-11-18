<?php

namespace App\Services\Delivery\ValueObjects\Dostavista;

class Address
{
    public function __construct(
        public string $address,
        public string $entrance_number,
        public string $floor_number,
        public string $apartment_number,
        public string $invisible_mile_navigation_instructions,
        public string $required_start_datetime,
        public string $required_finish_datetime,
        public string $note,
        public string $phone,
    )
    {}
}
