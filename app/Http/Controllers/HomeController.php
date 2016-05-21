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
     * check if the authentication is successful
     * @return a string ok if success
     */
    public function login(){
        echo 1;
    }
}
