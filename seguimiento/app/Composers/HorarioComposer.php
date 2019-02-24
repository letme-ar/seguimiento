<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 23/02/19
 * Time: 15:30
 */

namespace App\Composers;


use App\Models\Horario;
use Illuminate\View\View;

class HorarioComposer
{
    public function compose(View $view)
    {
        $view->horarios = $this->getHorarios();
    }

    private function getHorarios()
    {
        return Horario::pluck('descripcion','id')->toArray();
    }
}