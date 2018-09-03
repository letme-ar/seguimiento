<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Repositories\RepoDocentes;
use App\Validations\ValiDocentes;
use Illuminate\Http\Request;

class DocentesController extends Controller
{
    private $repoDocentes;

    public function __construct(RepoDocentes $repoDocentes)
    {
        $this->repoDocentes = $repoDocentes;
    }

    public function index()
    {
        return view("docentes.index",['docentes' => $this->repoDocentes->getAll()]);
    }

    public function create()
    {
        return view("docentes.form",['docente' => $this->repoDocentes->getModel()]);
    }

    public function store(Request $request)
    {
        $validaciones = new ValiDocentes($request->get('id'));
        $request->validate($validaciones->getRules());
        $this->repoDocentes->save($request);
        return redirect('docentes')->with('message', 'Guardado correctamente');
    }

    public function edit(Docente $docente)
    {
        return view("docentes.form",compact('docente'));
    }
}
