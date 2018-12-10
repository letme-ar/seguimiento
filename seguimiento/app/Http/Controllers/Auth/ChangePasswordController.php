<?php

namespace App\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 04/10/18
 * Time: 17:34
 */

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm(){
        return view('auth.change-password');
    }



}

