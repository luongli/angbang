<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Http\Request;
use Hash;

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
			'type' => 2,
			'password' => Hash::make($input['password']),
		]);
		print_r($user1);
	}
}