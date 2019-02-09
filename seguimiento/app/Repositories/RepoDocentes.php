<?php

namespace App\Repositories;
use App\Models\Docente;

class RepoDocentes extends RepoBase{

    public function getModel()
    {
        return new Docente();
    }

    public function getAll()
    {
        return $this->getModel()->orderBy('apellido','asc')->paginate(10);
    }


}
