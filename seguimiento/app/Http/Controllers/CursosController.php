<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCursoRequest;
use App\Http\Requests\EditCursoRequest;
use App\Models\Curso;

class CursosController extends Controller
{

    public function index()
    {
        $cursos = Curso::where('docente_id',auth()->user()->docente->id)->paginate(env('APP_PAGINATE',10));

        return view('cursos.index',compact('cursos'));
    }

    public function create()
    {
        return view('cursos.form');
    }

    public function store(CreateCursoRequest $request)
    {
        $request->save();

        return redirect('cursos')->with('message', 'Guardado correctamente');
    }

    public function edit($curso_id)
    {
        $curso = Curso::where('id',$curso_id)
            ->where('docente_id',auth()->user()->docente->id)
            ->firstOrFail();

        return view('cursos.form',compact('curso'));
    }

    public function update(EditCursoRequest $request,Curso $curso)
    {
        $request->update($curso);

        return redirect('cursos')->with('message', 'Guardado correctamente');

    }



}
