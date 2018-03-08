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

Route::get('/admin', function () {
    return view('admin.login');
});

Route::post('admin/login/validate', 'Admin\LoginController@index');


Route::group(['prefix'=>'admin','middleware'=> 'admin'], function(){

	Route::get('dashboard', 'Admin\DashboardController@index');

	Route::get('logout', 'Admin\LoginController@logout');

	// Route for movies
	Route::group(['prefix'=>'movies'], function(){
	   Route::get('/', 'Admin\MovieController@movieslist');
	   Route::get('/create','Admin\MovieController@createmovie');
	   Route::post('/submit','Admin\MovieController@submit');
	});


//	Route for screens
    Route::get('screens/create', 'Admin\ScreenController@create');
    Route::post('screens/submit', 'Admin\ScreenController@submit');
    Route::get('screens/delete', 'Admin\ScreenController@delete');
    Route::get('screens/{slug}/edit', 'Admin\ScreenController@edit');
    Route::post('screens/{slug}/update', 'Admin\ScreenController@update');
    Route::get('screens/{slug}/seat', 'Admin\ScreenController@seat');
    Route::get('screens/{slug}/seat/create', 'Admin\ScreenController@createSeat');
    Route::get('screens', 'Admin\ScreenController@lists');
//	Route for screens
});