<?php

namespace App\Http\Requests;

use App\Models\Curso;

class CreateCursoRequest extends CursoRequest
{
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
