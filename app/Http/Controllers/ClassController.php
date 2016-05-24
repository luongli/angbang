<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\DatabaseManager;
use File;
use DB;
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

    /**
     * get parents of a given class
     * @param class_id
     * @return a json object {parents: []}
     */
    public function get_parents_of_class($class_id)
    {
        $class = \App\Classes::find($class_id);
        $res = array();
        if(!is_null($class)){
            $children = $class->children;
            foreach($children as $child){
                $parents = $child->parents;
                foreach($parents as $parent) {
                    array_push($res, $parent['id']);
                }
            }
        }

        $kq = array('parents'=>$res);

        return Response::json($kq);
    }

    /**
     * return the name of all images of a class
     * @param class_id
     * @return json: {"pictures":[]}
     */
    public function get_album($class_id)
    {
        $res = DB::table('picture')
                    ->select('id', 'url')
                    ->where('id_class', '=', $class_id)
                    ->get();
        $kq = array('pictures'=>$res);
        return Response::json($kq);
    }
}
