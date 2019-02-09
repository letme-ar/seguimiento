<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 04/02/19
 * Time: 01:58
 */

namespace App\Repositories;


use App\Models\Curso;
use Illuminate\Support\Str;

class RepoCursos extends RepoBase
{

    public function getModel()
    {
        return new Curso();
    }

    public function setSlug($model)
    {
        return Str::slug($model->id."-".
            $model->materia->carrera->abreviacion."-".
            $model->materia->abreviatura."-".
            $model->anio."-".
            $model->dia->descripcion."-".
            $model->horario->descripcion);
    }
}
