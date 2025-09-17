<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
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
        return [
            'schedule_id' => 'required|integer|exists:App\Models\Schedule,id',
            'servicesIds' => 'required|array',
            'servicesIds.*' => 'integer|exists:App\Models\Service,id',
            'client_id' => 'nullable|integer|exists:App\Models\Client,id',
            'pyme_id' => 'required|integer|exists:App\Models\Pyme,id',
            'payment_method_id' => 'required|integer|exists:App\Models\PaymentMethod,id',
            'start_time' => 'required|date_format:H:i:s',
        ];
    }
}
