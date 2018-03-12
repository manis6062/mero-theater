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
	Route::group(['prefix'=>'box-office/movies'], function(){
	   Route::get('/', 'Admin\MovieController@movieslist');
	   Route::get('/create','Admin\MovieController@createmovie');
	   Route::post('/submit','Admin\MovieController@submit');
	   Route::get('{movieid}/edit','Admin\MovieController@editmovie');
       Route::get('{movieid}/view','Admin\MovieController@viewmovie');
	   Route::post('update/{movieid}','Admin\MovieController@update');
	   Route::get('delete/{movieid}','Admin\MovieController@deletemovie');
       Route::get('addmovieartists','Admin\MovieController@addartistformovie');
	});
    // Route for movies end

    // Route for Artists
    Route::group(['prefix'=>'box-office/artist'], function(){
       Route::get('/', 'Admin\ArtistsController@artistslist');
       Route::get('/create','Admin\ArtistsController@createartist');
       Route::post('/submit','Admin\ArtistsController@submit');
       Route::get('{artistsid}/edit','Admin\ArtistsController@editartist');
       Route::get('{artistsid}/view','Admin\ArtistsController@viewartist');
       Route::post('update/{artistsid}','Admin\ArtistsController@update');
       Route::get('delete/{artistsid}','Admin\ArtistsController@deleteartist');
    });
    // Route for artists end




//	Route for screens
    Route::group(['prefix'=>'seat-management'], function() {
        Route::get('screens/create', 'Admin\ScreenController@create');
        Route::post('screens/submit', 'Admin\ScreenController@submit');
        Route::get('screens/delete', 'Admin\ScreenController@delete');
        Route::get('screens/{slug}/edit', 'Admin\ScreenController@edit');
        Route::post('screens/{slug}/update', 'Admin\ScreenController@update');
        Route::get('screens/{slug}/seat', 'Admin\ScreenController@seat');
        Route::get('screens/{slug}/seat/create', 'Admin\ScreenController@createSeat');
        Route::post('screens/{slug}/seat/update', 'Admin\ScreenController@updateSeat');
        Route::get('screens/{slug}/seat/edit', 'Admin\ScreenController@editSeat');
        Route::post('screens/{slug}/seat/submit', 'Admin\ScreenController@submitSeat');
        Route::post('screens/{slug}/seat/ajax-call', 'Admin\ScreenController@ajaxCall');
        Route::get('screens', 'Admin\ScreenController@lists');
    });
//	Route for screens
});