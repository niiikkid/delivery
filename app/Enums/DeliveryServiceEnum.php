<?php

namespace App\Enums;

use App\Contracts\EnumContract;
use App\Traits\Enumable;

enum DeliveryServiceEnum: string implements EnumContract
{
    use Enumable;

    case DOSTAVISTA = 'dostavista';
}
