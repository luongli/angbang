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

Route::get('/v1/user/{id}', function ($id) {
	$user = App\User::find($id);
	return $user->toJson();
});
Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/register', function () {
	return View::make('auth.register');
});

Route::get('/v1/getavatar/{user_id}', 'HomeController@get_avatar');

Route::post('/register', 'PublicController@register');
