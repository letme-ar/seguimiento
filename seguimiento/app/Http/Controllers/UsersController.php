<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 23/01/19
 * Time: 20:26
 */

namespace App\Http\Controllers;


use App\Mail\MailWelcome;
use App\Repositories\RepoUsers;
use App\User;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    private $repoUsers;

    public function __construct(RepoUsers $repoUsers)
    {
        $this->repoUsers = $repoUsers;
    }


    public function destroy($docente_id)
    {
        $user = $this->repoUsers->defuse($docente_id);
        Mail::to($user->email,$user->nombre_apellido)->send(new MailWelcome($user));
        return redirect('docentes')->with('message', 'Guardado correctamente');
    }

    public function activate($docente_id)
    {
        $user = $this->repoUsers->activate($docente_id);
        Mail::to($user->email,$user->nombre_apellido)->send(new MailWelcome($user));
        return redirect('docentes')->with('message', 'Guardado correctamente');
    }
}
