<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;

class Step2Request extends FormRequest
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
            'postal_code' => 'required|string|max:20',
            'region'      => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'street'      => 'required|string|max:255',
            'house'       => 'required|string|max:50',
            'building'    => 'nullable|string|max:50',
            'apartment'   => 'nullable|string|max:50',
        ];
    }
}
