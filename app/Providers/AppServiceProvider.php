<?php

namespace App\Providers;

use App\API\Dostavista\DostavistaClient;
use App\API\Dostavista\DostavistaClientInterface;
use App\Contracts\DeliveryServiceContract;
use App\Mixins\ResponseMixins;
use App\Services\Delivery\DeliveryService;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DostavistaClientInterface::class, function () {
            return new DostavistaClient(
                config('dostavista.token'),
            );
        });
        $this->app->bind(DeliveryServiceContract::class, function () {
            return new DeliveryService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::mixin(new ResponseMixins());
    }
}
