<?php

namespace App\Services\Delivery\Deliveries\Calculator;

use App\API\Dostavista\DostavistaClientInterface;
use App\API\Dostavista\Requests\CalculateOrderRequest;
use App\API\Dostavista\Requests\ValueObjects\ContactPerson;
use App\API\Dostavista\Requests\ValueObjects\Point;
use App\Services\Delivery\Orders\DostavistaOrder;
use App\Services\Delivery\ValueObjects\DeliveryCalculatedValueObject;

class DostavistaCalculator extends BaseCalculator
{
    public function calc(DostavistaOrder $order): DeliveryCalculatedValueObject
    {
        $result = make(DostavistaClientInterface::class)
            ->calculateOrder(
                new CalculateOrderRequest(
                    type: $order->type,
                    matter: $order->matter,
                    vehicle_type_id: $order->vehicle_type_id,
                    total_weight_kg: $order->total_weight_kg,
                    insurance_amount: $order->insurance_amount,
                    is_motobox_required: $order->is_motobox_required,
                    payment_method: $order->payment_method,
                    bank_card_id: $order->bank_card_id,
                    points: [
                        new Point(
                            address: $order->from->address,
                            contact_person: new ContactPerson(
                                phone: $order->from->phone
                            ),
                            required_start_datetime: $order->from->required_start_datetime?->format('c'),
                            required_finish_datetime: $order->from->required_finish_datetime?->format('c'),
                            note: $order->from->note,
                            entrance_number: $order->from->entrance_number,
                            floor_number: $order->from->floor_number,
                            apartment_number: $order->from->apartment_number,
                            invisible_mile_navigation_instructions: $order->from->invisible_mile_navigation_instructions,
                        ),
                        new Point(
                            address: $order->to->address,
                            contact_person: new ContactPerson(
                                phone: $order->to->phone
                            ),
                            required_start_datetime: $order->to->required_start_datetime?->format('c'),
                            required_finish_datetime: $order->to->required_finish_datetime?->format('c'),
                            note: $order->to->note,
                            entrance_number: $order->to->entrance_number,
                            floor_number: $order->to->floor_number,
                            apartment_number: $order->to->apartment_number,
                            invisible_mile_navigation_instructions: $order->to->invisible_mile_navigation_instructions,
                        )
                    ]
                )
            );

        return new DeliveryCalculatedValueObject(
            payment_amount: $result['order']['payment_amount']
        );
    }
}
