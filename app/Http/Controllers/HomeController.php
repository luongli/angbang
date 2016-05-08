<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\DatabaseManager;
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
        $res = array();
        //array_push($res, count($children));
        foreach( $children as $child) {
            $tmp = array( 'id'=>$child['id'], 'fname'=>$child['fname'], 'lname'=>$child['lname']);
            array_push($res, $tmp);
        }

        return Response::json($res);
    }

    /**
     * This function return a list of class that a teacher is teaching in
     * @param id of teacher
     * @return json array of class id and class name
     */
    public function get_classes_of_teacher($teacher_id)
    {
        $teacher = \App\User::find($teacher_id);
        //check if user is a teacher
        if($teacher['type'] == 2){
            $classes = \App\User::find($teacher_id)->classes;
            //echo $classes;
            $res = array();
            foreach($classes as $class){
                $tmp = array(
                    'id'=>$class['id'],
                    'class_name'=>$class['class_name']
                );
                array_push($res, $tmp);
            }
            return Response::json($res);
        }else{
            echo 'not a teacher';
        }
    }
}
