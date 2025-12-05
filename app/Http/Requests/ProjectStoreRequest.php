<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'status' => 'required|string|max:50',
            'responsible' => 'required|string|max:100',
            'amount' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del proyecto es obligatorio.',
            'name.max' => 'El nombre del proyecto no puede exceder los 255 caracteres.',
            'name.string' => 'El nombre del proyecto debe ser una cadena de texto.',

            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            'start_date.required' => 'La fecha de inicio es obligatoria.',

            'status.required' => 'El estado del proyecto es obligatorio.',
            'status.string' => 'El estado del proyecto debe ser una cadena de texto.',
            'status.max' => 'El estado del proyecto no puede exceder los 50 caracteres.',

            'responsible.required' => 'El responsable del proyecto es obligatorio.',
            'responsible.string' => 'El responsable del proyecto debe ser una cadena de texto.',
            'responsible.max' => 'El responsable del proyecto no puede exceder los 100 caracteres.',

            'amount.required' => 'El monto del proyecto es obligatorio.',
            'amount.numeric' => 'El monto del proyecto debe ser un valor numérico.',
        ];
    }
}
