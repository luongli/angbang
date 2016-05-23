<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Response;
use View;
use DB;

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


	/**
	 * receive post from client
	 * @return a message about the creating new user
	 */
	public function regiser_for_app()
	{
		$fname = Input::get('fname');
		$lname = Input::get('lname');
		$email = Input::get('email');

		//check if email exists
		$query = DB::table('users')
						->where('email', '=', $email)->get();
		if(count($query) != 0) {
			return "Entered email already exists";
		}

		$birthday = Input::get('birthday');
		$sex = Input::get('sex');

		if($sex == 0) {
			$sex = false;
		} else {
			$sex = true;
		}

		$address = Input::get('address');
		$phone = Input::get('phone');
		$password = Input::get('password');
		$avatar = $_POST['avatar'];

		if($avatar != 'null') {
			$file = base64_decode($avatar);
			$file_name = str_random(30) . '.jpg';
			$path = storage_path() . '/avatar/';
			file_put_contents($path . $file_name, $file);
			$avatar = $file_name;
		} else {
			$avatar = null;
		}


		$user = \App\User::create([
			'fname' => $fname,
			'lname' => $lname,
			'email' => $email,
			'birthday' => $birthday,
			'sex' => $sex,
			'address' => $address,
			'phone' => $phone,
			'type' => 1,
			'password' => Hash::make($password),
			'avatar' => $avatar
		]);

		return "Account is created successfully";
	}
}