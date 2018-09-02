<?php

namespace App\Validations;

class ValiDocentes implements ValiBase{

    private $id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getRules()
    {
        return [
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'email' => "required|max:50|unique:docentes,email,{$this->id},id",
            'dni' => "required|unique:docentes,dni,{$this->id},id|numeric|digits_between:7,8",
            'legajo' => "required|unique:docentes,legajo,{$this->id},id|digits_between:3,20",
        ];
    }

}


?>