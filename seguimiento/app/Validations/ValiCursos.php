<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 04/02/19
 * Time: 11:16
 */

namespace App\Validations;


class ValiCursos implements ValiBase
{

    public function getRules()
    {
        return [
            'docente_id' => 'required | numeric',
            'materia_id' => 'required | numeric',
            'dia_id' => 'required | numeric',
            'horario_id' => 'required | numeric',
            'anio' => 'required|digits:4|integer|min:2015|max:'.(date('Y')+1),
            'ayudante_id' => 'numeric'
        ];

    }
}
