<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ClassController extends Controller
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
}
