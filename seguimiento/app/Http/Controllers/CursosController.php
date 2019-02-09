<?php

namespace App\Http\Controllers;

use App\Repositories\RepoCursos;
use App\Validations\ValiCursos;
use Illuminate\Http\Request;

class CursosController extends Controller
{
    private $repoCursos;

    public function __construct(RepoCursos $repoCursos)
    {
        $this->repoCursos = $repoCursos;
    }


    public function index()
    {
        return view('cursos.index');
    }

    public function create()
    {
        return view('cursos.form');
    }

    public function store(Request $request)
    {
        $validations = new ValiCursos();

        $request->merge([
            'docente_id' => \Auth::user()->docente_id,
            'slug' => '',
        ]);

        $request->validate($validations->getRules());

        $model = $this->repoCursos->save($request);

        $model->slug = $this->repoCursos->setSlug($model);

        $model->save();

        return redirect('cursos')->with('message', 'Guardado correctamente');
    }



}
