<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:15',
            'addressar' => 'required|string|min:10 | max:150',
            'addressen' => 'required|string|min:10 | max:150',
            'date' => 'required|date',
            'gender' => 'required|in:male,female',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
