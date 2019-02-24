<?php

namespace App\Providers;

use App\Composers\AnioComposer;
use App\Composers\AyudanteComposer;
use App\Composers\CarreraComposer;
use App\Composers\DiaComposer;
use App\Composers\HorarioComposer;
use App\Composers\MateriasComposer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerViewComposers();
    }

    private function registerViewComposers()
    {
        \View::composer('cursos.form',CarreraComposer::class);
        \View::composer('cursos.form',MateriasComposer::class);
        \View::composer('cursos.form',DiaComposer::class);
        \View::composer('cursos.form',HorarioComposer::class);
        \View::composer('cursos.form',AnioComposer::class);
        \View::composer('cursos.form',AyudanteComposer::class);
    }
}
