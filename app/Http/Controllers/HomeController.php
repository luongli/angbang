<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Get avatar of a specific user.
     * Avatar images will be stored on storage/avatar/{user_id} folder
     * 
     * @param user_id
     * @return image
     */
    public function get_avatar($user_id)
    {
        // the path should be changed depending on the OS
        $path = 'C:/Users/li/Documents/workspace/angbang/storage/avatar/' . $user_id . '/a.jpg';
        // check if the file exists
        if(File::exists($path)) {
            $image = Image::make($path)->resize(300, 300);
            return $image->response('jpg');
        }
        
        return 'Requested file does not exist';
    }

    /**
     * This function returns a list of students in a given class
     *
     * @param class_id
     * @return json contains an array of id and name of students in that class
     */
    public function get_class_list($class_id)
    {
        $children = \App\Classes::find($class_id)->children;
        //print_r($class);
        
        foreach( $children as $child) {
            echo $child;
        }
    }
}
