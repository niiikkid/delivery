<?php

namespace App\Services\Delivery\Deliveries\Validation;

class DostavistaValidation extends BaseValidation
{
    public function rules(): array
    {
        return [
            'type' => ['required', 'in:standard,same_day,hyperlocal'],
            'vehicle_type_id' => ['required', 'integer', 'in:1,2,3,4,5,6,7'],
            'total_weight_kg' => ['required', 'integer', 'min:0'],
            'matter' => ['required', 'string', 'min:3', 'max:5000'],
            'insurance_amount' => ['required', 'string', 'regex:/^\d+\.\d{2}$/i'],
            'is_motobox_required' => ['required', 'boolean'],
            'payment_method' => ['required', 'string', 'in:bank_card,cash'],
            'bank_card_id' => ['required_id:payment_method,bank_card', 'string', 'in:bank_card'],

            //from
            'from.address' => ['required', 'string', 'min:1', 'max:350'],
            'from.entrance_number' => ['required', 'string', 'min:1', 'max:100'],
            'from.floor_number' => ['required', 'string', 'min:1', 'max:100'],
            'from.apartment_number' => ['required', 'string', 'min:1', 'max:100'],
            'from.invisible_mile_navigation_instructions' => ['required', 'string', 'min:1', 'max:300'],
            'from.required_start_datetime' => [
                'required_if:type,standard',
                'prohibited_if:type,same_day,hyperlocal',
                'date'
            ],
            'from.required_finish_datetime' => [
                'required_if:type,standard',
                'prohibited_if:type,same_day,hyperlocal',
                'date'
            ],
            'from.note' => ['required', 'string', 'min:1', 'max:300'],
            'from.phone' => ['required', 'string', 'regex:/^7\d{10}$/i'],
            //to
            'to.address' => ['required', 'string', 'min:1', 'max:350'],
            'to.entrance_number' => ['required', 'string', 'min:1', 'max:100'],
            'to.floor_number' => ['required', 'string', 'min:1', 'max:100'],
            'to.apartment_number' => ['required', 'string', 'min:1', 'max:100'],
            'to.invisible_mile_navigation_instructions' => ['required', 'string', 'min:1', 'max:300'],
            'to.required_start_datetime' => [
                'required_if:type,standard,same_day',
                'prohibited_if:type,hyperlocal',
                'date'
            ],
            'to.required_finish_datetime' => [
                'required_if:type,standard,same_day',
                'prohibited_if:type,hyperlocal',
                'date'
            ],
            'to.note' => ['required', 'string', 'min:1', 'max:300'],
            'to.phone' => ['required', 'string', 'regex:/^7\d{10}$/i'],
        ];
    }
}
