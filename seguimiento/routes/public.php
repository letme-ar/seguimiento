<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 09/02/19
 * Time: 16:51
 */

Auth::routes();

Route::get('login','Auth\LoginController@getLogin');
Route::post('login', 'Auth\LoginController@authenticate')->name('login');
Route::post('change-password',['as' => 'change-password','uses' => 'ChangePasswordController@change']);
