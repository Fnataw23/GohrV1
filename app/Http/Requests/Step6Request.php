<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Step6Request extends FormRequest
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
            'status' => 'required|in:unknown,yes,no',
            'description' => 'required_if:status,yes|nullable|string|max:2000',
        ];
    }
}
