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
    return view('welcome');
});

Route::get('/theatre_admin', function () {
    return view('welcome');
});

Route::post('theatre_admin/login/validate', 'Admin\LoginController@index');


Route::group(['prefix'=>'theatre_admin','middleware'=> 'theatre_admin'], function(){

	Route::get('dashboard', 'Admin\DashboardController@index');

	Route::get('logout', 'Admin\LoginController@logout');

});