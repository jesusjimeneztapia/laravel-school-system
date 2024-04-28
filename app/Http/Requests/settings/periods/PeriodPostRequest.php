<?php

namespace App\Http\Requests\settings\periods;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PeriodPostRequest extends FormRequest
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
            'period' => 'required|min:4',
            'state' => ['required', Rule::in(['1', '0'])]
        ];
    }

    public function messages()
    {
        return [
            'period.required' => 'La :attribute es obligatoria.',
            'period.min' => 'La :attribute debe tener al menos :min caracteres.',
            'state.in' => "El :attribute solo puede tener los valores de 'ACTIVO' o 'INACTIVO'."
        ];
    }

    public function attributes()
    {
        return [
            'period' => 'gestión',
            'state' => 'estado'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->session()->put(config('constants.TOASTR'), [
            config('constants.TOASTR_MODE') => 'error',
            config('constants.TOASTR_MESSAGE') => 'Por favor verifique los campos',
            config('constants.TOASTR_TITLE') => 'Error al crear gestión'
        ]);

        parent::failedValidation($validator);
    }
}
