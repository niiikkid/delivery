<?php

namespace App\API\Dostavista\Requests\ValueObjects;

class Point
{
    public function __construct(
        public ?string $address,
        public ContactPerson $contact_person,
    )
    {}
}
