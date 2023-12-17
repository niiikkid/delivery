<?php

namespace App\Services\Delivery\ValueObjects;

class DeliveryCalculatedValueObject
{
    public function __construct(
        public string $payment_amount, //общая сумма платежа
        //TODO тут можно добавить дополнительные поля
    )
    {}
}
