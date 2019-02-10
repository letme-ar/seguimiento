<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Repositories\RepoCursos;
use App\Validations\ValiCursos;
use Illuminate\Http\Request;

class CursosController extends Controller
{

    private $valiCursos;

    public function __construct(ValiCursos $valiCursos)
    {
        $this->valiCursos = $valiCursos;
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
        $request->merge([
            'docente_id' => \Auth::user()->docente_id,
            'slug' => '',
        ]);

        $request->validate($this->valiCursos->getRules());

        $curso = new Curso($request->all());

        $curso->save();

        $curso->setSlug();

        return redirect('cursos')->with('message', 'Guardado correctamente');
    }

    public function edit(Curso $curso)
    {
        return view('cursos.form',compact('curso'));
    }

    public function update(Request $request,Curso $curso)
    {
        $request->merge([
            'docente_id' => $curso->docente_id,
            'slug' => $curso->slug,
        ]);

        $request->validate($this->valiCursos->getRules());

        $curso->fill($request->all());

        $curso->setSlug();

        $curso->save();

        return redirect('cursos')->with('message', 'Guardado correctamente');

    }



}
