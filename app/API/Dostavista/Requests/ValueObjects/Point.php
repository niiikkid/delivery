<?php

namespace App\API\Dostavista\Requests\ValueObjects;

class Point
{
    public function __construct(
        public ?string $address = null,
        public ?ContactPerson $contact_person = null,
        public ?string $client_order_id = null,
        public ?string $latitude = null,
        public ?string $longitude = null,
        public ?string $required_start_datetime = null,
        public ?string $required_finish_datetime = null,
        public ?string $taking_amount = null,
        public ?string $buyout_amount = null,
        public ?string $note = null,
        public ?bool $is_order_payment_here = null,
        public ?string $building_number = null,
        public ?string $entrance_number = null,
        public ?string $intercom_code = null,
        public ?string $floor_number = null,
        public ?string $apartment_number = null,
        public ?string $invisible_mile_navigation_instructions = null,
        public ?bool $is_cod_cash_voucher_required = null,
        public ?int $delivery_id = null,
        public ?array $packages = null,
    )
    {}
}
