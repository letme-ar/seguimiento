<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::post('login', 'Auth\LoginController@authenticate')->name('login');

Route::group(['middleware' => 'auth'],function(){
    Route::resource('docentes','DocentesController');
    Route::get('docentes.defuse/{docente}',['as' => 'docentes.defuse','uses' => 'DocentesController@defuse']);
    Route::get('docentes.activate/{docente}',['as' => 'docentes.activate','uses' => 'DocentesController@activate']);
    Route::get('/home', 'HomeController@index')->name('home');
});


