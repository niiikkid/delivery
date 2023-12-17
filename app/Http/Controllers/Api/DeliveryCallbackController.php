<?php

namespace App\Http\Controllers\Api;

use App\Contracts\DeliveryServiceContract;
use App\Enums\DeliveryServiceEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryCallbackController extends Controller
{
    public function create(Request $request, DeliveryServiceEnum $deliveryService)
    {
        make(DeliveryServiceContract::class)
            ->handleCallback($request, $deliveryService);

        return response()->success();
    }
}
