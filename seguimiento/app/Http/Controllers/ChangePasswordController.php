<?php

namespace App\Http\Controllers;
//use Illuminate\Http\Request;
use App\Repositories\RepoUsers;
use App\Validations\ValiChangePassword;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: damian
 * Date: 04/10/18
 * Time: 17:34
 */

class ChangePasswordController extends Controller
{

    private $repoUsers;
    private $valiChangePassword;

    public function __construct(RepoUsers $repoUsers,ValiChangePassword $valiChangePassword)
    {
        $this->repoUsers = $repoUsers;
        $this->valiChangePassword = $valiChangePassword;
    }

    public function showChangePasswordForm(){
        return view('auth.change-password');
    }

    public function change(Request $request)
    {
        $request->validate(
            $this->valiChangePassword->getRules(),
            $this->valiChangePassword->getMessages()
        );

        $user = $this->repoUsers->getModel()->find(\Auth::user()->id);

        if (!\Hash::check($request->get('password'), $user->password))
        {
            return redirect()->back()->withErrors(['password'=>'El password ingresado es incorrecto']);
        }

        $user->changePassword($request->get('new_password'));

        return redirect('/')->with('message', 'Guardado correctamente');
    }


}

