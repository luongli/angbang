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

// UserController

Route::get('/v1/getavatar/{user_id}', 'UserController@get_avatar');

Route::get('/v1/get/user_info/{user_id}', 'UserController@get_user_info');

Route::get('/v1/get/user_detail/{email}', 'UserController@get_user_detail');

Route::get('/v1/get/classes_of_teacher/{teacher_id}', 'UserController@get_classes_of_teacher');

Route::get('/v1/get/classes_of_parent/{parent_id}', 'UserController@get_classes_of_parent');

Route::get('/v1/get/classes_of_user/{user_id}', 'UserController@get_classes_of_user');

Route::get('/v1/get/children_of_parent/{parent_id}', 'UserController@get_children_of_parent');

Route::get('/v1/get/relevant_people/{user_id}', 'UserController@get_relevant_people');

Route::get('/v1/get/teachers_of_class/{class_id}', 'UserController@get_teachers_of_class');

Route::post('/v1/create/post', 'UserController@create_post');


// Class controller
Route::get('/v1/get/class_list/{class_id}', 'ClassController@get_class_list');

Route::get('/v1/get/class_info/{class_id}', 'ClassController@get_class_info');

Route::get('/v1/get/parents_of_class/{class_id}', 'ClassController@get_parents_of_class');

Route::get('/v1/get/picture_of_class/{class_id}/{file_name}', 'ClassController@get_picture_of_class');

Route::get('/v1/get/album/{class_id}', 'ClassController@get_album');



// Home controller
Route::get('/home', 'HomeController@index');

Route::get('/v1/get/child_picture/{child_id}', 'HomeController@get_child_picture');

Route::get('/v1/get/parents_of_child/{child_id}', 'HomeController@get_parents_of_child');

Route::get('/v1/get/child_info/{child_id}', 'HomeController@get_child_info');

Route::get('/v1/login', 'HomeController@login');

Route::get('/v1/new_feeds/{user_id}/{date}', 'HomeController@get_new_feeds');

Route::post('images/store','HomeController@storeImage');


// Public Controller
Route::get('/register', 'PublicController@get_register');

Route::post('/register', 'PublicController@register');

Route::get('/test/{param1}&{param2}', 'PublicController@test');

Route::get('/upload', function() {
	return view('upload');
});

Event::listen('illuminate.query', function($query){
    var_dump($query);
});
