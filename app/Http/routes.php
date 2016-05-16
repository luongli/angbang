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

Route::get('/v1/get/child_picture/{child_id}', 'HomeController@get_child_picture');

Route::get('/v1/get/class_list/{class_id}', 'HomeController@get_class_list');

Route::get('/v1/get/classes_of_teacher/{teacher_id}', 'HomeController@get_classes_of_teacher');

Route::get('/v1/get/teachers_of_class/{class_id}', 'HomeController@get_teachers_of_class');

Route::get('/v1/get/parents_of_child/{child_id}', 'HomeController@get_parents_of_child');

Route::get('/v1/get/children_of_parent/{parent_id}', 'HomeController@get_children_of_parent');

Route::get('/v1/get/user_info/{user_id}', 'HomeController@get_user_info');

Route::get('/v1/get/class_info/{class_id}', 'HomeController@get_class_info');

Route::get('/v1/get/child_info/{child_id}', 'HomeController@get_child_info');

Route::get('/v1/get/relevant_people/{user_id}', 'HomeController@get_relevant_people');

Route::get('/v1/login', 'HomeController@login');

Route::get('/register', 'PublicController@get_register');

Route::post('/register', 'PublicController@register');

Route::get('/test', 'PublicController@test');

Route::post('images/store','HomeController@storeImage');

Route::get('/upload', function() {
	return view('upload');
});

Event::listen('illuminate.query', function($query){
    var_dump($query);
});
