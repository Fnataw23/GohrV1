<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;

class Step1Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'mn' => $this->boolean('mn'),
        ]);
    }

    public function rules(): array
    {
        return [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:1000',
            'phone' => 'required|string|max:12',
            'email' => 'required|email',
            'snils' => 'required|string|max:14',
            'mn' => 'boolean',
            'comment' => 'nullable|string|max:1000',
        ];
    }
}
