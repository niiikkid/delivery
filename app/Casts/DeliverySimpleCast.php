<?php

namespace App\Casts;

use App\Enums\DeliveryServiceEnum;
use App\Models\Delivery;
use App\ValueObjects\DeliverySimpleValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DeliverySimpleCast implements CastsAttributes
{
    public bool $withoutObjectCaching = true;

    /**
     * Cast the given value.
     *
     * @param  Delivery  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (DeliveryServiceEnum::DOSTAVISTA->equals($model->service)) {
            return new DeliverySimpleValueObject(
                status: $model->meta_data['order']['status'],
                sub_status: $model->meta_data['delivery']['status'] ?? '',
                //TODO тут можно добавить новые необходимые поля
            );
        } else {
            throw new \Exception('Service not implemented.');
        }
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        throw new \Exception('This cast only for presentation.');
    }
}
