<?php

namespace App\Services\Delivery\Orders;

use App\Enums\DeliveryServiceEnum;
use App\Services\Delivery\ValueObjects\Dostavista\Address;

class DostavistaOrder extends BaseOrder
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
        public ?int $bank_card_id = null,
    )
    {}

    public function deliveryService(): DeliveryServiceEnum
    {
        return DeliveryServiceEnum::DOSTAVISTA;
    }
}
