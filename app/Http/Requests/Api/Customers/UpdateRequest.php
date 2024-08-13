<?php

namespace App\Http\Requests\Api\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string',
            'tax' => [
                'sometimes',
                'string',
                Rule::unique('customers', 'tax')->ignore($this->route('customer')->id),
            ],
            'email' => [
                'sometimes',
                'email',
                Rule::unique('customers', 'email')->ignore($this->route('customer')->id),
            ],
        ];
    }
}
