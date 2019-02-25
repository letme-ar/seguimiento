<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 25/02/19
 * Time: 15:04
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

abstract class CursoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'materia_id' => 'required | numeric',
            'dia_id' => 'required | numeric',
            'horario_id' => 'required | numeric',
            'anio' => 'required|digits:4|integer|min:2015|max:'.(date('Y')+1)
        ];
    }

    public function messages()
    {
        return [
            'materia_id.required' => 'El campo materia es obligatorio',
            'dia_id.required' => 'El campo dia es obligatorio',
            'horario_id.required' => 'El campo horario es obligatorio',
            'anio.required' => 'El campo año es obligatorio'
        ];
    }

}