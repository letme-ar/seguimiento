<?php

namespace App\Repositories;
use App\Models\Docente;

class RepoDocentes implements RepoBase{

    public function getModel()
    {
        return new Docente();
    }

    public function create($request)
    {
        $docente = $this->getModel();
        $docente->fill($request->except('_token'));
        $docente->save();
    }

    public function getAll()
    {
        return $this->getModel()->paginate(10);
    }


}