<?php

namespace App\Http\Requests\Pyme;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePymeRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'logo_url' => 'nullable|file|image|max:2048',
            'type_pyme_id' => 'sometimes|required|exists:App\Models\TypePyme,id',
        ];
    }
}
