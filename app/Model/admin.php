<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Date;
use Jenssegers\Mongodb\Schema\Blueprint;
use App\Model\Tests;
use View;
use Redirect;
use Input;




use App\Http\Requests;

class admin extends Eloquent
{
    //

    protected $connection = 'mongodb';
    protected $collection = "adminUsers";



    public static function index($input){
        $model=new self();
        $name=$input['name'];
        $role=$input['role'];
        $pwd=$input['password'];
        $model->name=$name;
        $model->role=$role;
        $model->password=$pwd;
        $isSave=$model->save();
        if($isSave){
            return "Successfully saved";
        }
        else{
            return "Unknown error occured";
        }


    }

    public static function login($input)
    {
        $model = new self();
        $name = $input['u'];
        $pwd = $input['p'];
        $role = $_POST['role'];
        $user = $model::where('name', '=', $name)->where('password', '=', $pwd)->first();
        if(!isset($user) || count($user) == 0){
            return "bye";
            return Redirect::to('login')->with('message', 'Login Failed');
        }
        else{
            $test=questions::all();
            return View::Make('dashboard')->with('test',$test);

        }
       /* if ($name == $user->name && $pwd == $user->password) {

            return Redirect::to('dashboard');


        }
        if ($name != $user->name && $pwd != $user->password) {

                return "bye";
                return Redirect::to('login')->with('message', 'Login Failed');;


            }*/
        }


    public static function testDetails($input){
        return $_GET['action'] ;
    }



}
