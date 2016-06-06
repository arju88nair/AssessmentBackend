<?php

namespace App\Http\Controllers;
use App\Model\addUser;
use App\Model\upload;
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
    public function upload_file(Request $request)
    {
        return upload::upload($request->all());



        foreach($files as $file) {
            $destinationPath = public_path() .'/uploads/';
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
        }
        return Redirect::to('upload')->with('success', 'Upload successfully');
    }


    public function download(Request $request){

        if(!$request->has('sessionHandle')){
            return array ("code" => "1", "status" => "error", "message" => "Session handle field can't be found") ;
        }
        if(!$request->has('testId')){
            return array ("code" => "1", "status" => "error", "message" => "Test Id can't be found") ;
        }


        return upload::download($request->all());


    }
}
