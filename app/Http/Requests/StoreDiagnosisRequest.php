<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiagnosisRequest extends FormRequest
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
            'diagnosis_en' => 'required|string|max:255',
            'diagnosis_ar' => 'required|string|max:255',
            'medicines' => 'required|array',
            'medicines.*.medicine' => 'required|integer|exists:medicines,id',
            'medicines.*.dosage' => 'required|numeric|min:1',
            'medicines.*.frequency' => 'required|string|max:100',
            'medicines.*.description' => 'required|string|max:255',
        ];
    }
}
