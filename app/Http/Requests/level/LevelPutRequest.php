<?php

namespace App\Http\Requests\level;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LevelPutRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'period_id' => 'required',
            'name' => ['required', Rule::in(['INICIAL', 'PRIMARIA', 'SECUNDARIA'])],
            'shift' => ['required', Rule::in(['MAÑANA', 'TARDE', 'NOCHE'])]
        ];
    }

    public function messages()
    {
        return [
            'period_id.required' => 'La :attribute es obligatoria.',
            'name.required' => 'El :attribute es obligatorio.',
            'name.in' => "El :attribute solo puede tener los valores de 'INICIAL', 'PRIMARIA' o 'SECUNDARIA'.",
            'shift.required' => 'El :attribute es obligatorio.',
            'shift.in' => "El :attribute solo puede tener los valores de 'MAÑANA', 'TARDE' o 'NOCHE'."
        ];
    }

    public function attributes()
    {
        return [
            'period_id' => 'gestión',
            'name' => 'nivel',
            'shift' => 'turno'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->session()->put(config('constants.TOASTR'), [
            config('constants.TOASTR_MODE') => 'error',
            config('constants.TOASTR_MESSAGE') => 'Por favor verifique los campos',
            config('constants.TOASTR_TITLE') => 'Error al actualizar nivel'
        ]);

        parent::failedValidation($validator);
    }
}
