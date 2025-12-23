<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;

class Step4Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'job_title' => 'required|string|max:255',
            'retiree' => 'boolean',
            'disabled' => 'boolean',
            'organization_option' => 'required|in:none,existing,new',

            // Валидация для существующей организации
            'existing_organization_id' => 'required_if:organization_option,existing|nullable|exists:organizations,id',

            // Валидация для новой организации
            'organization.name' => 'required_if:organization_option,new|nullable|string|max:255',
            'organization.legal_form' => 'required_if:organization_option,new|nullable|string|max:100',
            'organization.phone' => 'required_if:organization_option,new|nullable|string|max:20',
            'organization.email' => 'required_if:organization_option,new|nullable|email|max:255',
            'organization.postal_code' => 'required_if:organization_option,new|nullable|string|max:20',
            'organization.region' => [
                'required_if:organization_option,new',
                'nullable',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if ($value && !in_array($value, config('regions'))) {
                        $fail('Выбран несуществующий регион для организации');
                    }
                },
            ],
            'organization.city' => 'required_if:organization_option,new|nullable|string|max:255',
            'organization.street' => 'required_if:organization_option,new|nullable|string|max:255',
            'organization.house' => 'required_if:organization_option,new|nullable|string|max:50',
            'organization.building' => 'nullable|string|max:50',
            'organization.apartment' => 'nullable|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'job_title.required' => 'Поле "Должность" обязательно для заполнения',
            'job_title.max' => 'Должность не должна превышать 255 символов',

            'organization_option.required' => 'Выберите вариант организации',
            'organization_option.in' => 'Неверный вариант организации',

            'existing_organization_id.required_if' => 'Выберите организацию из списка',
            'existing_organization_id.exists' => 'Выбранная организация не существует',

            'organization.name.required_if' => 'Наименование организации обязательно',
            'organization.legal_form.required_if' => 'Организационно-правовая форма обязательна',
            'organization.phone.required_if' => 'Телефон организации обязателен',
            'organization.email.required_if' => 'Email организации обязателен',
            'organization.email.email' => 'Введите корректный email адрес',
            'organization.postal_code.required_if' => 'Почтовый индекс обязателен',
            'organization.region.required_if' => 'Регион обязателен',
            'organization.city.required_if' => 'Населенный пункт обязателен',
            'organization.street.required_if' => 'Улица обязательна',
            'organization.house.required_if' => 'Номер дома обязателен',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'retiree' => $this->boolean('retiree'),
            'disabled' => $this->boolean('disabled'),
        ]);
    }
}
