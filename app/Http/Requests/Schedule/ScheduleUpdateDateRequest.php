<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleUpdateDateRequest extends FormRequest
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
            'schedule' => 'required|array',
            'schedule.*.id' => 'required|integer|exists:schedules,id',
            'schedule.*.start_time' => 'sometimes|required|date_format:H:i',
            'schedule.*.end_time' => 'sometimes|required|date_format:H:i|after:start_time',
            'schedule.*.is_active' => 'boolean',
        ];
    }
}
