<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Response;
use View;

class PublicController extends Controller {
	/**
	 * Handle new user register
	 * 
	 * @return void
	**/
	public function register () {
		$input = Input::all();
		$user1 = \App\User::create([
			'fname' => 'Nguyen',
			'lname' => $input['name'],
			'email' => $input['email'],
			'birthday' => '1995-04-05',
			'sex' => true,
			'address' => 'Hanoi, Vietnam',
			'phone' => '0964756453',
			'type' => 1,
			'password' => Hash::make($input['password']),
		]);
		print_r($user1);
	}

	/**
	 * Response to register of GET method
	 *
	 * @return response
	 */
	public function get_register() {
		return View::make('auth.register');
	}

	/**
	 * This route is used to test connection
	 * return a string
	 */
	public function test($param1, $param2){
		echo $param1;
		echo $param2;
	}
}