<?php

namespace App\Services\Delivery\Deliveries\Calculators;

use App\Services\Delivery\ValueObjects\Dostavista\Address;

class DostavistaCalculator extends BaseCalculator
{
    public function __construct(
        public string $type,
        public string $vehicle_type_id,
        public string $total_weight_kg,
        public Address $from,
        public Address $to,
        public string $matter,
        public string $insurance_amount,
        public bool $is_motobox_required,
        public string $payment_method,
        public int $bank_card_id,
        public string $client_order_id,
    )
    {}

    public function calc(): array
    {


        return [];
    }
}
