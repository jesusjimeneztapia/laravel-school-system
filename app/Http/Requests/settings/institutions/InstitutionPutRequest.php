<?php

namespace App\Http\Requests\settings\institutions;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class InstitutionPutRequest extends FormRequest
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
            'name' => 'required|min:3',
            'direction' => 'required|min:5',
            'email' => 'nullable|email',
            'phone' => 'nullable|min:7|max:100',
            'cellphone' => 'nullable|min:8|max:100',
            'logo' => 'nullable|image'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'name.min' => 'El :attribute debe tener al menos :min caracteres.',
            'direction.required' => 'La :attribute es obligatoria.',
            'direction.min' => 'La :attribute debe tener al menos :min caracteres.',
            'email.email' => 'El :attribute es inválido.',
            'phone.min' => 'El :attribute debe tener al menos :min caracteres.',
            'phone.max' => 'El :attribute debe tener máximo :min caracteres.',
            'cellphone.min' => 'El :attribute debe tener al menos :min caracteres.',
            'cellphone.max' => 'El :attribute debe tener máximo :min caracteres.',
            'logo.image' => 'El :attribute debe ser una imagen.'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre la institución',
            'direction' => 'dirección',
            'email' => 'correo electrónico',
            'phone' => 'teléfono',
            'cellphone' => 'celular',
            'logo' => 'logo de la institución'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->session()->put(config('constants.TOASTR'), [
            config('constants.TOASTR_MODE') => 'error',
            config('constants.TOASTR_MESSAGE') => 'Por favor verifique los campos',
            config('constants.TOASTR_TITLE') => 'Error al actualizar intitución'
        ]);

        parent::failedValidation($validator);
    }
}
