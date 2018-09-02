<?php

namespace App\Http\Controllers;

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
        $docentes = $this->repoDocentes->getAll();
        return view("docentes.index",compact('docentes'));
    }

    public function create()
    {
        return view("docentes.form");
    }

    public function store(Request $request)
    {
        $request->validate(ValiDocentes::getRules());
        $this->repoDocentes->create($request);
        return redirect('docentes')->with('message', 'Guardado correctamente');

    }
}
