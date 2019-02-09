<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 09/02/19
 * Time: 16:50
 */



Route::get('/', function () {
    return view('home');
});


Route::resource('docentes','DocentesController');

Route::resource('cursos','CursosController');

Route::put('/users/{docente_id}','UsersController@activate')->name('users.activate');
Route::delete('/users/{docente_id}','UsersController@destroy')->name('users.defuse');

Route::get('/home', 'HomeController@index')->name('home');


Route::get('change-password',['as' => 'change-password','uses' => 'ChangePasswordController@showChangePasswordForm']);
