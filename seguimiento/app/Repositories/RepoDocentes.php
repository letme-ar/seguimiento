<?php

namespace App\Repositories;
use App\Models\Docente;

class RepoDocentes implements RepoBase{

    public function getModel()
    {
        return new Docente();
    }

    public function save($request)
    {
        $docente = $this->getModel()->firstOrNew(['id' => $request->get('id')]);
        $docente->fill($request->except('_token'));
        $docente->save();
    }

    public function getAll()
    {
        return $this->getModel()->paginate(10);
    }


}