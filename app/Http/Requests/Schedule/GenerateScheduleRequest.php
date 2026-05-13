<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class GenerateScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'court_id' => [
                'required',
                'exists:courts,id',
            ],

            'schedule_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
        ];
    }
}