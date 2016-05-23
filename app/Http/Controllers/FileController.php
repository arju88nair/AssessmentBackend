<?php

namespace App\Http\Controllers;
use App\Model\addUser;
use View;
use Redirect;
use Input;

use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Date;
use Jenssegers\Mongodb\Schema\Blueprint;


use App\Http\Requests;

class FileController extends Controller {


    public function index()
    {
        return view('form');
    }
    public function upload_file()
    {


        $name=Input::get('username');
        $files = Input::file('images');
        $user=addUser::where('userId','=',$name)->get();
        return $user;
        if(!isset($user) || count($user) ==0){
            return "No user found";
        }
        else
        {
            if(if (Input::hasFile('photo'))
            {
                //
            })
        }
       /* foreach($files as $file) {
            $destinationPath = public_path() .'/uploads/';
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
        }
        return Redirect::to('upload')->with('success', 'Upload successfully');*/
    }
}
