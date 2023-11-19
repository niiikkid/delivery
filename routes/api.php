<?php

use App\API\Dostavista\DostavistaClientInterface;
use App\API\Dostavista\Requests\CalculateOrderRequest;
use App\API\Dostavista\Requests\ValueObjects\ContactPerson;
use App\API\Dostavista\Requests\ValueObjects\Point;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['s2s_auth']], function () {
    Route::post('delivery/calculate/{deliveryService}', [OrderController::class, 'calculate']);
    Route::post('delivery/create/{deliveryService}', [OrderController::class, 'create']);
});

Route::any('test-create', function () {
    $result = make(DostavistaClientInterface::class)
        ->calculateOrder(
            new CalculateOrderRequest(
                type: 'standard',
                matter: 'То да сё, разный хлам из кладовки.',
                vehicle_type_id: 1,
                total_weight_kg: 100,
                payment_method: 'cash',
                points: [
                    new Point(
                        address: 'Москва, ул. Покровка, 11',
                        contact_person: new ContactPerson(
                            phone: '79020791269',
                        )
                    ),
                    new Point(
                        address: 'ул. Профсоюзная, 46 к. 1, Москва, 117335',
                        contact_person: new ContactPerson(
                            phone: '79020791288',
                        )
                    )
                ],
            )
        );

    return response()->success($result);
});


Route::any('test-status', function () {
    $result = make(DostavistaClientInterface::class)
        ->getOrders(
            new \App\API\Dostavista\Requests\GetOrdersRequest(
                status: 'new'
            )
        );

    return response()->success($result);
});
