<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;

class Step3Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // НЕ должно быть hunter_id!

            // Только поля из формы паспорта:
            'series'     => 'required|string|size:4',
            'number'     => 'required|string|size:6',
            'issue_date' => 'required|date|before_or_equal:today',
            'issuer'     => 'required|string|max:255',
            'unit_code'  => 'nullable|string|max:20',
        ];
    }

    // Опционально: кастомные сообщения
    public function messages(): array
    {
        return [
            'series.required' => 'Серия паспорта обязательна',
            'series.size' => 'Серия паспорта должна содержать 4 цифры',
            'number.required' => 'Номер паспорта обязателен',
            'number.size' => 'Номер паспорта должен содержать 6 цифр',
            'issue_date.required' => 'Дата выдачи обязательна',
            'issue_date.before_or_equal' => 'Дата выдачи не может быть будущей',
            'issuer.required' => 'Кем выдан обязательно',
        ];
    }
}
