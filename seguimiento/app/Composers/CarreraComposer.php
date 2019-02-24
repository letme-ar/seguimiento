<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 23/02/19
 * Time: 12:36
 */

namespace App\Composers;


use App\Models\Carrera;
use Illuminate\View\View;

class CarreraComposer
{
    public function compose(View $view)
    {
        $view->carreras = $this->getCarreras();
    }

    private function getCarreras()
    {
        return Carrera::pluck('descripcion','id')
            ->toArray();
    }


}