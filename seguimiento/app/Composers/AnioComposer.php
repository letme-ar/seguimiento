<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 23/02/19
 * Time: 15:36
 */

namespace App\Composers;


use Illuminate\View\View;

class AnioComposer
{
    public function compose(View $view)
    {
        $view->anios = $this->getAnios();
    }

    private function getAnios()
    {
        return [
            date("Y") - 1 => date("Y") - 1,
            date("Y") => date("Y"),
            date("Y") + 1 => date("Y") + 1
        ];
    }
}