<?php

namespace App\Http\Requests\Order;

use App\Contracts\DeliveryServiceContract;
use App\Services\Delivery\Deliveries\Validation\BaseValidation;
use Illuminate\Foundation\Http\FormRequest;

class CalculateRequest extends FormRequest
{
    protected BaseValidation $deliveryServiceValidation;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $this->deliveryServiceValidation = make(DeliveryServiceContract::class)->getValidation(
            $this->route('deliveryService')
        );

        return $this->deliveryServiceValidation->rules();
    }
}
