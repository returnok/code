<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



    Route::get('/', function () {
        return view('welcome');
    });
    Route::any('admin/login','Admin\LoginController@Login');
    Route::get('admin/code','Admin\LoginController@Code');

Route::group(['middleware'=>'admin.login','prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::any('index','AdminController@Index');
    Route::get('info','AdminController@Info');
    Route::get('quit','LoginController@quit');
    Route::any('pass','AdminController@pass');
});