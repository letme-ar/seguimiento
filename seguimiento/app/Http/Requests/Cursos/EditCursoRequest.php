<?php

namespace App\Http\Requests;

use App\Models\Curso;
use Illuminate\Foundation\Http\FormRequest;

class EditCursoRequest extends CursoRequest
{
    public function update(Curso $curso)
    {
        $data = $this->validated();

        $data['docente_id'] = $curso->docente_id;
        $data['slug'] = $curso->slug;

        $curso->fill($data);

        $curso->save();

        $curso->setSlug();
    }
}
