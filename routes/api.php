<?php

use App\API\Dostavista\DostavistaClientInterface;
use App\API\Dostavista\Requests\CalculateOrderRequest;
use App\API\Dostavista\Requests\ValueObjects\ContactPerson;
use App\API\Dostavista\Requests\ValueObjects\Point;
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
