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

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/v1/getavatar/{user_id}', 'HomeController@get_avatar');

Route::get('/v1/get/class_list/{class_id}', 'HomeController@get_class_list');

Route::get('/v1/get/classes_of_teacher/{teacher_id}', 'HomeController@get_classes_of_teacher');

Route::get('/register', 'PublicController@get_register');

Route::post('/register', 'PublicController@register');

Event::listen('illuminate.query', function($query){
    var_dump($query);
});
