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

//Route::get('/', function () {
//    return view('auth.login');
//});

Auth::routes();

Route::get('login','Auth\LoginController@getLogin');
Route::post('login', 'Auth\LoginController@authenticate')->name('login');
Route::post('change-password',['as' => 'change-password','uses' => 'ChangePasswordController@change']);

Route::group(['middleware' => ['auth','change_password']],function(){
    Route::get('/', function () {
        return view('home');
    });


    Route::resource('docentes','DocentesController');

    Route::put('/users/{docente_id}','UsersController@activate')->name('users.activate');
    Route::delete('/users/{docente_id}','UsersController@destroy')->name('users.defuse');

    Route::get('/home', 'HomeController@index')->name('home');


    Route::get('change-password',['as' => 'change-password','uses' => 'ChangePasswordController@showChangePasswordForm']);
});


