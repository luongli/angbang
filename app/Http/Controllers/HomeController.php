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

    /**
     * This function return a list of teachers who is working on a given class
     * @param id of a class
     * @return json array of teacher id, fname, mname, lname
     */
    public function get_teachers_of_class($class_id)
    {
        $teachers = \App\Classes::find($class_id)->teachers;
        $res = array();
        if(!is_null($teachers)){
            foreach($teachers as $teacher){
                $tmp = array(
                    'id'=>$teacher['id'],
                    'fname'=>$teacher['fname'],
                    'mname'=>$teacher['mname'],
                    'lname'=>$teacher['lname']
                );
                array_push($res, $tmp);
            }
        }
        return Response::json($res);
    }

    /**
     * get_user_info function is used to get details of a specific user
     * 
     * @param user_id
     * @return a json: id, fname, mname, lname, birthday, sex, address, phone, type, avatar
     */
     public function get_user_info($user_id)
     {
        $user = \App\User::find($user_id);
        if(!is_null($user)){
            return $user->toJson();
        }else{
            echo "null";
        }
     }

     /**
     * get_class_info function is used to get details of a specific class
     * 
     * @param class_id
     * @return a json: id, class_name, course, num_of_student
     */
    public function get_class_info($class_id)
    {
        $class = \App\Classes::find($class_id);
        if(!is_null($class)){
            return $class->toJson();
        }else{
            echo "null";
        }
    }

    /**
     * get_child_info function is used to get details of a specific child
     * 
     * @param child_id
     * @return a json: id, fname, mname, lname, birthday, sex, address, mood, health, temperature, sleep, food, id_class
     */
    public function get_child_info($child_id)
    {
        $child = \App\Children::find($child_id);
        if(!is_null($child)){
            return $child->toJson();
        }else{
            echo "null";
        }
    }

    /**
     * get_parents_of_child returns a list of parents of a given child
     * 
     * @param child_id
     * @return an array of parents including: id, fname, mname, lname
     */
    public function get_parents_of_child($child_id)
    {
        $parents = \App\Children::find($child_id)->parents;
        $res = array();
        if(!is_null($parents)){
            foreach($parents as $parent){
                $tmp = array(
                    'id'=>$parent['id'],
                    'fname'=>$parent['fname'],
                    'mname'=>$parent['mname'],
                    'lname'=>$parent['lname']
                );
                array_push($res, $tmp);
            }
        }
        return Response::json($res);
    }

    /**
     * get_children_of_parent returns a list of children of a given parent
     * 
     * @param parent_id
     * @return an json array of children including: id, fname, mname, lname
     */
    public function get_children_of_parent($parent_id)

    {
        $parent = \App\User::find($parent_id);
        $res = array();

        // need to check for parent
        if(!is_null($parent)){
            $children = $parent->children;
            foreach($children as $child){
                $tmp = array(
                    'id'=>$child['id'],
                    'fname'=>$child['fname'],
                    'mname'=>$child['mname'],
                    'lname'=>$child['lname']
                );
                array_push($res, $tmp);
            }
        }
        return Response::json($res);
    }
}

