<?php

namespace App\Http\Requests;

use App\Models\Curso;
use Illuminate\Foundation\Http\FormRequest;

class CreateCursoRequest extends FormRequest
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

    public function save()
    {
        $data = $this->validated();
        $data['docente_id'] = auth()->user()->docente->id;
        $data['slug'] = '';

        $curso = new Curso($data);

        $curso->save();

        $curso->setSlug();
    }

}
