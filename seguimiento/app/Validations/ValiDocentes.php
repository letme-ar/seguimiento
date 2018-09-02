<?php

namespace App\Validations;

class ValiDocentes implements ValiBase{

    public static function getRules()
    {
        return [
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'email' => 'required|max:50|unique:docentes',
            'dni' => 'required|unique:docentes|numeric|digits_between:7,8',
            'legajo' => 'required|unique:docentes|digits_between:3,20',
        ];
    }

}


?>