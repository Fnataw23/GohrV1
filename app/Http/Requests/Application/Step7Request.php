<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;

class Step7Request extends FormRequest
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
            'series' => 'required|string|max:20',
            'number' => 'required|string|max:50',
            'issue_date' => 'required|date',
            'is_cancelled' => 'boolean',
            'cancellation_date' => 'nullable|date|after_or_equal:issue_date',
            'cancellation_reason' => 'nullable|string|max:1000',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'is_cancelled' => $this->boolean('is_cancelled'),
        ]);
    }
}
