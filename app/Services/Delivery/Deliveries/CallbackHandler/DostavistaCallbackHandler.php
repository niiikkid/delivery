<?php

namespace App\Services\Delivery\Deliveries\CallbackHandler;

use App\API\Dostavista\DostavistaClientInterface;
use App\Models\Delivery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DostavistaCallbackHandler extends BaseCallbackHandler
{
    public function handle(Request $request): void
    {
        cache()->lock('delivery-callback-dostavista', 10)
            ->block(5, function () use ($request) {
                $callback_data = make(DostavistaClientInterface::class)->handleCallback($request);

                if (empty($callback_data['order']) && empty($callback_data['delivery'])) {
                    throw new \Exception('Invalid callback data.');
                }

                $external_order_id = ! empty($callback_data['order']) ? $callback_data['order']['order_id'] : $callback_data['delivery']['order_id'];

                $delivery = $this->getDelivery($external_order_id);

                $meta_data = $delivery->meta_data;

                $event_datetime = Carbon::parse($callback_data['event_datetime'])
                    ->timezone(now()->timezone->getName())
                    ->toDateTimeString();

                if (! empty($callback_data['order'])) {
                    $meta_data['order'] = $callback_data['order'];
                    $meta_data['order_updated_at'] = $event_datetime;
                } else {
                    $meta_data['delivery'] = $callback_data['delivery'];
                    $meta_data['delivery_updated_at'] = $event_datetime;
                }

                $delivery->update(['meta_data' => $meta_data]);
            });
    }

    protected function getDelivery(mixed $external_order_id): Delivery
    {
        return Delivery::where('external_order_id', $external_order_id)->first();
    }
}
