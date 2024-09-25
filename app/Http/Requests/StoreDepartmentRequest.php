<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
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
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'addressEn' => 'required|string|max:255',
            'addressAr' => 'required|string|max:255',
            'descriptionEn' => 'required|string|max:500',
            'descriptionAr' => 'required|string|max:500',
        ];
    }
}
