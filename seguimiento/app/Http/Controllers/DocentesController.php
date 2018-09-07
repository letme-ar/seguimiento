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
        $docentes = $this->repoDocentes->getAll();
//        dd($docentes[0]->user->status);
        return view("docentes.index",compact('docentes'));
    }

    public function create()
    {
        $docente = $this->repoDocentes->getModel();
        return view("docentes.form",compact('docente'));
    }

    public function store(Request $request)
    {
        $validations = new ValiDocentes();
        $validations->setId($request->get('id'));
        $request->validate($validations->getRules());
        $docente = $this->repoDocentes->save($request);
        $this->repoUsers->save($docente);
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
