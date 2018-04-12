<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['prefix' => 'V1', 'namespace' => 'API\V1'], function(){
    Route::post('user/register', 'UserController@register');
    Route::post('user/login', 'UserController@login');
    Route::post('user/social-media-login/facebook', 'UserController@fbLogin');
    Route::group(['middleware' => 'apiauth'], function(){
        Route::post('settings/change-password', 'SettingsController@changePassword');
        Route::post('settings/change-password/confirmation', 'SettingsController@changePasswordConfirmation');
        Route::post('profile/update', 'UserController@updateProfile');
        Route::get('movies/now-showing', 'MoviesController@getNowShowingMovies');
    });
});
