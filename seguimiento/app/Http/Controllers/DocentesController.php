<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDocenteRequest;
use App\Http\Requests\EditDocenteRequest;
use App\Models\Docente;

class DocentesController extends Controller
{
    public function index()
    {
        $docentes = Docente::orderBy('apellido','asc')->paginate(env('APP_PAGINATE',10));

        return view("docentes.index",compact('docentes'));
    }

    public function create()
    {
        $docente = new Docente();

        return view("docentes.form",['docente' => $docente]);
    }

    public function show(Docente $docente,$url)
    {
        return view("docentes.show",compact('docente'));
    }

    public function store(CreateDocenteRequest $request)
    {
        $request->save();

        return redirect('docentes')->with('message', 'Guardado correctamente');
    }

    public function edit(Docente $docente,$url)
    {
        return view("docentes.form",compact('docente'));
    }

    public function update(EditDocenteRequest $request,Docente $docente)
    {
        $request->update($docente);

        return redirect('docentes')->with('message', 'Guardado correctamente');
    }
}
