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
        $id = Input::get('testId');
        $files = Input::file('images');
        $user = addUser::where('userId', '=', $name)->first();
        if (!isset($user) || count($user) == 0) {
            return "No user found";
        }
        if (!Input::hasFile('images')) {
            return "No file found";
        }
        if (Input::hasFile('images')) {
            foreach ($files as $file) {
                $destinationPath = public_path() . '/uploads/';
                $filename = $file->getClientOriginalName();
                $name = Input::get('testId') . "@" . $filename;


                $file->move($destinationPath, $name);
                $success = $user->savedReports()->create(array("filePath" => $name));
                $pathToFile = $destinationPath . $name;
                if ($success) {
                    /* return response()->download($pathToFile);*/
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


    public static function download($input)
    {

        $model = new self();
        $handle = $input['sessionHandle'];
        $user = $model::where('usrSessionHdl', "=", $handle)->first();
        if (!isset($user) || count($user) == 0) {
            return array("code" => "1", "status" => "error", "message" => "User can't be found");
        } else {
            $reports = $user->savedReports;
            foreach ($reports as $item) {
                $file = $item['filePath'];
                $arr = explode("@", $file, 2);
                $first = $arr[0];
                if (!isset($first) || count($first) == 0) {
                    return array("code" => "1", "status" => "error", "message" => "Report can't be found");
                } else {
                    $name = 'report';
                    $headers = array(
                        'Content-Type: application/pdf',
                    );
                    $destinationPath = public_path() . '/uploads/' . $file;
                    return $destinationPath;
                    return response()->download($destinationPath, $file, $headers);
                }


            }
        }

    }

}
