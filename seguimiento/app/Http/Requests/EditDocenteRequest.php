<?php

namespace App\Http\Requests;

use App\Models\Docente;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class EditDocenteRequest extends FormRequest
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
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'email' => "required|email|max:50|unique:docentes,email,{$this->docente->id},id",
            'dni' => "required|unique:docentes,dni,{$this->docente->id},id|numeric|digits_between:7,8",
            'legajo' => "required|unique:docentes,legajo,{$this->docente->id},id|digits_between:3,20",
        ];
    }

    public function update(Docente $docente)
    {
        $data = $this->validated();

        DB::transaction(function () use ($data,$docente){

            $docente->fill($data)->save();

            $user = $this->fillUpdateUser($docente->user,$docente);

            $user->save();

        });

    }

    private function fillUpdateUser($user,$docente)
    {
        $user->fill([
            'nombre' => $docente->nombre,
            'apellido' => $docente->apellido,
            'dni' => $docente->dni,
            'email' => $docente->email
        ]);

        return $user;
    }


}
