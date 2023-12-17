<?php

use App\Http\Controllers\Api\DeliveryCallbackController;
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

Route::any('delivery/callback/{deliveryService}', [DeliveryCallbackController::class, 'create']);

Route::group(['middleware' => ['s2s_auth']], function () {
    Route::post('delivery/order/calculate/{deliveryService}', [OrderController::class, 'calculate']);
    Route::post('delivery/order/create/{deliveryService}', [OrderController::class, 'create']);
    Route::get('delivery/order/status/{delivery}', [OrderController::class, 'get']);
});
