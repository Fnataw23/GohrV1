<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;

class Step5Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'series' => 'required|string|max:10',
            'number' => 'required|string|max:20',
            'issue_date' => 'required|date|before_or_equal:today',
            'issuer' => 'required|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'series.required' => 'Серия членского билета обязательна',
            'number.required' => 'Номер членского билета обязателен',
            'issue_date.required' => 'Дата выдачи обязательна',
            'issue_date.date' => 'Некорректная дата',
            'issuer.required' => 'Поле "Кем выдан" обязательно',
        ];
    }
}
