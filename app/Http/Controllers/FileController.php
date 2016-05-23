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



       /* foreach($files as $file) {
            $destinationPath = public_path() .'/uploads/';
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
        }
        return Redirect::to('upload')->with('success', 'Upload successfully');*/
    }
}
