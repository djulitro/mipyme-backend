<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleCreateRequest extends FormRequest
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
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'start_date' => 'required|date',
            'days_of_week' => 'required|array|min:1',
            'days_of_week.*' => 'in:1,2,3,4,5,6,7', // 1=Monday, 7=Sunday
            'include_holidays' => 'boolean',
            'exclude_dates' => 'array',
            'exclude_dates.*' => 'date',
        ];
    }
}
