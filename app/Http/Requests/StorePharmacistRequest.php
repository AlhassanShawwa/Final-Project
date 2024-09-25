<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacistRequest extends FormRequest
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
            'firstnamear' => 'required|string|max:40',
            'lastnamear' => 'required|string|max:40',
            'firstnameen' => 'required|string|max:40',
            'lastnameen' => 'required|string|max:40',
            'phone' => 'required|string|max:15',
            'date' => 'required|date',
            'gender' => 'required|in:male,female',
            'pharmacy' => 'required|exists:pharmacies,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
