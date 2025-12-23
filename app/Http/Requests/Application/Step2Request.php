<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;

class Step2Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'postal_code' => 'required|string|max:20',
            'region'      => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (!in_array($value, config('regions'))) {
                        $fail('Выбран несуществующий регион');
                    }
                },
            ],
            'city'        => 'required|string|max:255',
            'street'      => 'required|string|max:255',
            'house'       => 'required|string|max:50',
            'building'    => 'nullable|string|max:50',
            'apartment'   => 'nullable|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'region.required' => 'Пожалуйста, выберите регион',
            'region.string' => 'Регион должен быть строкой',
        ];
    }
}
