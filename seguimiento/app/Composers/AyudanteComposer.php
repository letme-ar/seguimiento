<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 23/02/19
 * Time: 16:45
 */

namespace App\Composers;


use App\Models\Docente;
use Illuminate\View\View;

class AyudanteComposer
{
    public function compose(View $view)
    {
        $view->ayudantes = $this->getAyudantes();
    }

    private function getAyudantes()
    {
        return Docente::where('id','<>',auth()->user()->docente->id)
            ->select('id', \DB::raw("concat(apellido, ', ',nombre) as descripcion"))
            ->orderBy('apellido','asc')
            ->pluck('descripcion','id')->toArray();

    }
}