<?php

namespace App\Models;

use App\Casts\DeliverySimpleCast;
use App\Enums\DeliveryServiceEnum;
use App\ValueObjects\DeliverySimpleValueObject;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property DeliveryServiceEnum $service
 * @property string $external_order_id
 * @property array $meta_data
 * @property DeliverySimpleValueObject $present
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'service',
        'external_order_id',
        'meta_data',
    ];

    protected $casts = [
        'service' => DeliveryServiceEnum::class,
        'meta_data' => 'array',
        'present' => DeliverySimpleCast::class,
    ];
}
