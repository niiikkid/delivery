<?php

namespace App\API\Dostavista\Requests;

class CreateOrderRequest extends Request
{
    protected $method = 'post';
    protected $uri = '/calculate-order';

    public function __construct(
        public ?string $type = null,
        public ?string $matter = null,
        public ?int $vehicle_type_id = null,
        public ?int $total_weight_kg = null,
        public ?string $insurance_amount = null,
        public ?bool $is_client_notification_enabled = null,
        public ?bool $is_contact_person_notification_enabled = null,
        public ?bool $is_route_optimizer_enabled = null,
        public ?int $loaders_count = null,
        public ?string $backpayment_details = null,
        public ?bool $is_motobox_required = null,
        public ?string $payment_method = null,
        public ?int $bank_card_id = null,
        public ?string $promo_code = null,
        public ?array $points = null,
    )
    {}
}
