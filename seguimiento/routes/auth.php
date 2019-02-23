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

///////////////////////* Docentes */////////////////////////////

Route::resource('docentes','DocentesController');

Route::get('docentes/show/{docente}-{url}', [
    'as' => 'docentes.show',
    'uses' => 'DocentesController@show'
]);

Route::get('docentes/edit/{docente}-{url}', [
    'as' => 'docentes.edit',
    'uses' => 'DocentesController@edit'
]);

Route::post('docentes/{docente}/update',[
   'as' => 'docentes.update',
   'uses' => 'DocentesController@update'
]);

//////////////////////////* End Docentes *//////////////////////////////

Route::resource('cursos','CursosController');

Route::post('cursos/{curso}/update',[
    'as' => 'curso.update',
    'uses' => 'CursosController@update'
]);

Route::get('cursos/edit/{curso}-{slug}', [
    'as' => 'cursos.edit',
    'uses' => 'CursosController@edit'
]);



Route::delete('users/{user}/defuse',[
    'as' => 'users.defuse',
    'uses' => 'UsersController@defuse'
]);

Route::post('users/{user}/activate',[
    'as' => 'users.activate',
    'uses' => 'UsersController@activate'
]);

Route::post('users/{user}/restartPassword',[
    'as' => 'users.restartPassword',
    'uses' => 'UsersController@restartPassword'
]);

Route::get('/home', 'HomeController@index')->name('home');


Route::get('change-password',['as' => 'change-password','uses' => 'ChangePasswordController@showChangePasswordForm']);
