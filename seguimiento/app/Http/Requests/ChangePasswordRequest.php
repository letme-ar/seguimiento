<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => ['required',function ($attribute, $value, $fail) {
                if (!\Hash::check($value, auth()->user()->password)) {
                    return $fail(__('El password ingresado es incorrecto.'));
                }
            }],
            'new_password' => 'min:6|confirmed|different:password'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Debe ingresar el password anterior',
            'new_password.required' => 'Debe ingresar el nuevo password',
            'new_password.different' => 'Debe ingresar un nuevo password diferente al anterior',
            'new_password.min' => 'El nuevo password debe tener al menos 6 caracteres',
            'new_password.confirmed' => 'La confirmación del nuevo password no coincide con el password ingresado',
        ];
    }

    public function save()
    {
        $data = $this->validated();

        auth()->user()->changePassword($data['new_password']);
    }

}
