<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserPutRequest extends FormRequest
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
            'role_id' => 'required',
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'nullable|min:8'
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'El :attribute es obligatorio.',
            'name.required' => 'El :attribute es obligatorio.',
            'name.min' => 'El :attribute debe tener al menos :min caracteres.',
            'email.required' => 'El :attribute es obligatorio.',
            'email.email' => 'El :attribute es inválido.',
            'password.min' => 'La :attribute debe tener al menos :min caracteres.',
        ];
    }

    public function attributes()
    {
        return [
            'role_id' => 'rol',
            'name' => 'nombre del usuario',
            'email' => 'correo electrónico',
            'password' => 'contraseña'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->session()->put(config('constants.TOASTR'), [
            config('constants.TOASTR_MODE') => 'error',
            config('constants.TOASTR_MESSAGE') => 'Por favor verifique los campos',
            config('constants.TOASTR_TITLE') => 'Error al actualizar usuario'
        ]);

        parent::failedValidation($validator);
    }
}
