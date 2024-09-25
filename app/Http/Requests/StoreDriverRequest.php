<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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
            'firstnamear' => 'required|string|max:255',
            'lastnamear' => 'required|string|max:255',
            'firstnameen' => 'required|string|max:255',
            'lastnameen' => 'required|string|max:255',
            'license_number' => 'required',
            'phone' => 'required|string|max:15',
            'date' => 'required|date',
            'ambulance' => 'required|exists:ambulances,id',
        ];
    }
}
