<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'start_date' => 'sometimes|date',
            'status' => 'sometimes|string|max:50',
            'responsible' => 'sometimes|string|max:100',
            'amount' => 'sometimes|numeric',
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
            'name.sometimes' => 'El campo nombre es obligatorio cuando esta presente.',
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.max' => 'El campo nombre no debe exceder los 255 caracteres.',

            'start_date.sometimes' => 'El campo fecha de inicio es obligatorio cuando esta presente.',
            'start_date.date' => 'El campo fecha de inicio debe ser una fecha válida.',

            'status.sometimes' => 'El campo estado es obligatorio cuando esta presente.',
            'status.string' => 'El campo estado debe ser una cadena de texto.',
            'status.max' => 'El campo estado no debe exceder los 50 caracteres.',

            'responsible.sometimes' => 'El campo responsable es obligatorio cuando esta presente.',
            'responsible.string' => 'El campo responsable debe ser una cadena de texto.',
            'responsible.max' => 'El campo responsable no debe exceder los 100 caracteres.',

            'amount.sometimes' => 'El campo monto es obligatorio cuando esta presente.',
            'amount.numeric' => 'El campo monto debe ser un valor numérico.',
        ];
    }
}
