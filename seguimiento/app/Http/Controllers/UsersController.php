<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 23/01/19
 * Time: 20:26
 */

namespace App\Http\Controllers;


use App\Mail\MailWelcome;
use App\User;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

    public function defuse(User $user)
    {
        $user->defuse();

        Mail::to($user->email,$user->nombre_apellido)->send(new MailWelcome($user));

        return redirect('docentes')->with('message', 'Guardado correctamente');
    }

    public function activate(User $user)
    {
        $user->activate();

        Mail::to($user->email,$user->nombre_apellido)->send(new MailWelcome($user));

        return redirect('docentes')->with('message', 'Guardado correctamente');
    }

    public function restartPassword(User $user)
    {
        $user->restartPassword();

        return redirect('docentes')->with('message', 'Guardado correctamente');
    }
}
