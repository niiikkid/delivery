<?php

namespace App\API\Dostavista\Requests\ValueObjects;

class Package
{
    public function __construct(
        public ?string $ware_code = null,
        public ?string $description = null,
        public ?float $items_count = null,
        public ?string $item_payment_amount = null,
        public ?string $nomenclature_code = null,
    )
    {}
}
