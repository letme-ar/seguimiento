<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 23/02/19
 * Time: 15:25
 */

namespace App\Composers;


use App\Models\Dia;
use Illuminate\View\View;

class DiaComposer
{
    public function compose(View $view)
    {
        $view->dias = $this->getDias();
    }

    private function getDias()
    {
        return Dia::pluck('descripcion','id')->toArray();
    }
}