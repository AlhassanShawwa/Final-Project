<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyRequest extends FormRequest
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
            'namear' => 'required|string|max:40',
            'nameen' => 'required|string|max:40',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:15',
            'location' => 'required|string|min:10 | max:150',
            'type' => 'required|in:external,internal',
        ];
    }
}
