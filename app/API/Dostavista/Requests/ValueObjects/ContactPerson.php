<?php

namespace App\API\Dostavista\Requests\ValueObjects;

class ContactPerson
{
    public function __construct(
        public ?string $phone = null,
        public ?string $name = null
    )
    {}
}
