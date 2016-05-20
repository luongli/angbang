<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\DatabaseManager;
use File;
use Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.basic');
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
        $path = storage_path() .'/avatar/' . $user_id . '/a.jpg';
        
        // check if the file exists        
        if(File::exists($path)) {
            $image = Image::make($path)->resize(300, 300);
            return $image->response('jpg');
        }
        
        return 'Requested file does not exist';
        
    }

    /**
     * Get avatar picture of a child
     * 
     * @param child_id
     * @return image
     */
    public function get_child_picture($child_id)
    {
        // the image will be store at storage/child_avatar/{child_id}.jpg
        $path = storage_path() . '/child_avatar/' . $child_id . '.jpg';

        if(File::exists($path)) {
            $image = Image::make($path);
            return $image->response('jpg');
        }

        return 'Requested file does not exist';
    }

    /**
     * handle picture upload from client
     */
     public function storeImage()
     {

        /*
        $id = Input::get('id');
        $post->category_for= Input::get('username');
        $post->title= Input::get('status');
        */
        //Log::info(Input)
        //print_r(Input::file('image'));
        //$encoded_image = Input::get('image');
        //$file = Input::file('image');
        $encoded_image = $_POST['image'];
        $file = base64_decode($encoded_image);
        file_put_contents(public_path() . '\images\abc.jpg', $file);
        $name = Input::get('name');
        
        echo $name;
        //$file = base64_decode($encoded_image);
        
        /*
        $post->longitude=Input::get('long');
        $post->latitude=Input::get('lat');          
        */
        /*
        $destinationPath = public_path().'/images/';
        $filename        = str_random(6) . '_' . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        */
        /*
        $post->image = '/images/'. $filename;
        $post->save();
        */
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

    /**
     * check if the authentication is successful
     * @return a string ok if success
     */
    public function login(){
        echo 1;
    }

    /**
     * get relevant people of a user who is parent
     * @param user
     * @return an array
     */
    public function get_relevant_of_parent($user)
    {
        $children = $user->children;
        $classes = array();
        //$teachers = null;
        $users = array();
        foreach($children as $child) {
            /* get the list of class ids that
            the children of a parent is participating in
            */
            $classes[(string)$child['id_class']] = \App\Classes::find($child['id_class']);
        }
        foreach($classes as $class_id => $class){
            $id_teachers = $class->id_teachers;
            foreach ($id_teachers as $id) {
                /*
                Get the ids of teachers who are teaching that class
                */
                if($id['id'] != $user['id'])
                    // only push person who is not requesting this api
                    array_push($users, $id['id']);
            }
            //array_merge($users, $id_teachers);
            //$id_parents = $class->children->id_parents;
            foreach($class->children as $child){
                // get the list of parents of a child
                $id_parents = $child->id_parents;
                foreach($id_parents as $id){
                    if($id['id'] != $user['id'])
                        // only push person who is not requesting this api
                        array_push($users, $id['id']);
                }
            }
            //remove duplicated element
            $users = array_unique($users);
        }
        return $users;
    }

    /**
     * get all people who are working in the same class or
     * are parents of children in that class
     * @param user_id
     * @return an array
     */
    public function get_relevant_of_teacher($user)
    {
        // find the classes the teacher is working on
        $classes = $user->classes;
        $users = array();

        foreach($classes as $class){
            // get the list of teachers of a class
            $teachers = $class->teachers;
            // add teachers id to array
            foreach($teachers as $teacher){
                if($teacher['id'] != $user['id'])
                    // make sure that the id of requesting user is not added to array
                    array_push($users, $teacher['id']);
            }

            // get the list of parents in a class
            foreach($class->children as $child){
                // get the list of parents of a child
                foreach($child->parents as $parent){
                    if($parent['id'] != $user['id'])
                        // make sure that the id of requesting user is not added to array
                        array_push($users, $parent['id']);
                }
            }
        }

        $users = array_unique($users);
        return $users;
    }

    /**
     * return an array of ids of people (except the requesting person) who are in the same class
     * @param user_id
     * @return json
     */
    public function get_relevant_people($user_id)
    {
        $user = \App\User::find($user_id);
        if(!is_null($user)){
            // if user is found
            if($user['type'] == 1){
                // if user is parent
                return Response::json($this->get_relevant_of_parent($user));
                //return $this->test($user);
            } else {
                // else user is teacher
                return Response::json($this->get_relevant_of_teacher($user));
                //return $this->test($user);
            }
        } else {
            // if user not found, reponse an empty json
            return Response::json(array());
        }
    }

    /**
     * get all information about a particular user
     * @param email
     * @return json
     */

    public function get_user_detail($email) {
        $user = \App\User::where('email', '=', $email)->first();
        if(!is_null($user)){
            return $user->toJson();
        }else{
            echo "[]";
        }
    }


}
