<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 23/01/19
 * Time: 20:26
 */

namespace App\Http\Controllers;


use App\Mail\MailWelcome;
use App\Models\Docente;
use App\User;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

    public function destroy(Docente $docente)
    {
        $docente->user->defuse();

        Mail::to($docente->user->email,$docente->user->nombre_apellido)->send(new MailWelcome($docente->user));

        return redirect('docentes')->with('message', 'Guardado correctamente');
    }

    public function activate(Docente $docente)
    {
        $docente->user->defuse();

        Mail::to($docente->user->email,$docente->user->nombre_apellido)->send(new MailWelcome($docente->user));

        return redirect('docentes')->with('message', 'Guardado correctamente');
    }
}
