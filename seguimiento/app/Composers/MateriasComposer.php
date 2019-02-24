<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 23/02/19
 * Time: 14:38
 */

namespace App\Composers;


use App\Models\Materia;
use Illuminate\View\View;

class MateriasComposer
{
    public function compose(View $view)
    {
        $view->materias = $this->getMaterias();
    }

    private function getMaterias()
    {
        return Materia::pluck('descripcion','id')
            ->toArray();
    }


}