<?php

namespace App\Services\Delivery\Deliveries\CallbackHandler;

use Illuminate\Http\Request;

abstract class BaseCallbackHandler
{
    abstract public function handle(Request $request): void;
}
