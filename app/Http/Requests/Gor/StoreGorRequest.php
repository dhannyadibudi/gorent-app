<?php

namespace App\Http\Requests\Gor;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreGorRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'address' => [
                'required',
                'string'
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'max:2048'
            ],

            'is_active' => [
                'required',
                'boolean'
            ],
        ];
    }
}
