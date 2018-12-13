<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/12/18
 * Time: 16:35
 */
namespace App\Validations;

class ValiChangePassword implements ValiBase
{

    public function getRules()
    {
        return [
            'password' => 'required',
            'new_password' => 'min:6|confirmed|different:password'
        ];
    }

    public function getMessages()
    {
        return [
            'password.required' => 'Debe ingresar el password anterior',
            'new_password.required' => 'Debe ingresar el nuevo password',
            'new_password.different' => 'Debe ingresar un nuevo password diferente al anterior',
            'new_password.min' => 'El nuevo password debe tener al menos 6 caracteres',
            'new_password.confirmed' => 'La confirmación del nuevo password no coincide con el password ingresado',
        ];
    }
}