<?php

namespace App\Http\Requests\Court;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourtRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'gor_id' => [
                'required',
                'exists:gors,id'
            ],

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'price_per_hour' => [
                'required',
                'numeric',
                'min:0'
            ],

            'open_time' => [
                'required'
            ],

            'close_time' => [
                'required',
                'after:open_time'
            ],

            'is_active' => [
                'required',
                'boolean'
            ],

        ];
    }
}
