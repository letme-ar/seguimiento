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

    public function __construct(RepoUsers $repoUsers)
    {
        $this->repoUsers = $repoUsers;
    }

    public function showChangePasswordForm(){
        return view('auth.change-password');
    }

    public function change(Request $request)
    {
        $validations = new ValiChangePassword();
        $request->validate($validations->getRules(),$validations->getMessages());

        if (!\Hash::check($request->get('password'), auth()->user()->current_password))
        {
            return redirect()->back()->withErrors(['password'=>'El password ingresado es incorrecto']);
        }

        auth()->user()->changePassword($request->get('new_password'));

        return redirect('/')->with('message', 'Guardado correctamente');


    }


}

