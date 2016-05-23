<?php

namespace App\Model;

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

class upload extends Eloquent
{
    protected $connection = "mongodb";
    protected $collection = "addedusers";




    public static function upload()
    {
        $name = Input::get('username');
        $files = Input::file('images');
        $user = addUser::where('userId', '=', $name)->first();
        if (!isset($user) || count($user) == 0) {
            return "No user found";
        } else {
            if (Input::hasFile('images')) {
                foreach ($files as $file) {
                    $destinationPath = public_path() . '/uploads/';
                    $filename = $file->getClientOriginalName();
                    $name = $destinationPath . $filename;
                    $file->move($destinationPath, $filename);
                    $success = $user->savedReports()->create(array("filePath" => $name));
                    if ($success) {
                        return Redirect::to('upload')->with('success', 'Upload successfully');


                    } else {
                        return array("code" => "1", "status" => "error");
                    }
                }


                //
            } else {
                return "Unknown error";
            }
        }
//
    }
}
