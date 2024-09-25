<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'namear' => 'required|string|max:255',
            'nameen' => 'required|string|max:255',
            'department' => 'required|exists:departments,id',
            'descriptionar' => 'nullable|string',
            'descriptioneen' => 'nullable|string',
            'services.*.service_id' => 'required|exists:services,id',
            'services.*.quantity' => 'required|integer|min:1',
            'services.*.total' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'tax_rate' => 'nullable|numeric',
        ];
    }
}
