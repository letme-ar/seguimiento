<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Repositories\RepoDocentes;
use App\Repositories\RepoUsers;
use App\Validations\ValiDocentes;
use Illuminate\Http\Request;

class DocentesController extends Controller
{
    private $repoDocentes;
    private $repoUsers;

    public function __construct(RepoDocentes $repoDocentes,RepoUsers $repoUsers)
    {
        $this->repoDocentes = $repoDocentes;
        $this->repoUsers = $repoUsers;
    }

    public function index()
    {
        $lista = $this->repoDocentes->getAll();
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

    public function defuse(Docente $docente)
    {
        $this->repoUsers->defuse($docente->id);
        return redirect('docentes')->with('message', 'Guardado correctamente');
    }

    public function activate(Docente $docente)
    {
        $this->repoUsers->activate($docente->id);
        return redirect('docentes')->with('message', 'Guardado correctamente');
    }
}
