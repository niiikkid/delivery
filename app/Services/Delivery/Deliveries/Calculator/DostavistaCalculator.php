<?php

namespace App\Services\Delivery\Deliveries\Calculator;

use App\API\Dostavista\DostavistaClientInterface;
use App\API\Dostavista\Requests\CalculateOrderRequest;
use App\API\Dostavista\Requests\ValueObjects\ContactPerson;
use App\API\Dostavista\Requests\ValueObjects\Point;
use App\Services\Delivery\ValueObjects\Dostavista\Address;

class DostavistaCalculator extends BaseCalculator
{
    protected Address $from;
    protected Address $to;

    public function __construct(
        protected string $type,
        protected string $vehicle_type_id,
        protected string $total_weight_kg,
        array $from,
        array $to,
        protected string $matter,
        protected string $insurance_amount,
        protected bool $is_motobox_required,
        protected string $payment_method,
        protected ?int $bank_card_id = null,
    )
    {
        $this->from = make(Address::class, $from);
        $this->to = make(Address::class, $to);
    }

    public function calc(): array
    {
        return make(DostavistaClientInterface::class)
            ->calculateOrder(
                new CalculateOrderRequest(
                    type: $this->type,
                    matter: $this->matter,
                    vehicle_type_id: $this->vehicle_type_id,
                    total_weight_kg: $this->total_weight_kg,
                    insurance_amount: $this->insurance_amount,
                    is_motobox_required: $this->is_motobox_required,
                    payment_method: $this->payment_method,
                    bank_card_id: $this->bank_card_id,
                    points: [
                        new Point(
                            address: $this->from->address,
                            contact_person: new ContactPerson(
                                phone: $this->from->phone
                            ),
                            required_start_datetime: $this->from->required_start_datetime,
                            required_finish_datetime: $this->from->required_finish_datetime,
                            note: $this->from->note,
                            entrance_number: $this->from->entrance_number,
                            floor_number: $this->from->floor_number,
                            apartment_number: $this->from->apartment_number,
                            invisible_mile_navigation_instructions: $this->from->invisible_mile_navigation_instructions,
                        ),
                        new Point(
                            address: $this->to->address,
                            contact_person: new ContactPerson(
                                phone: $this->to->phone
                            ),
                            required_start_datetime: $this->to->required_start_datetime,
                            required_finish_datetime: $this->to->required_finish_datetime,
                            note: $this->to->note,
                            entrance_number: $this->to->entrance_number,
                            floor_number: $this->to->floor_number,
                            apartment_number: $this->to->apartment_number,
                            invisible_mile_navigation_instructions: $this->to->invisible_mile_navigation_instructions,
                        )
                    ]
                )
            );
    }
}
