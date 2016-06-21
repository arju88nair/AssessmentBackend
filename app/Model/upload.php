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
    protected $collection = "reports";


    public static function upload()
    {
        $model = new self();
        $name = Input::get('username');
        $sId = Input::get('userHandle');
        $id = Input::get('testId');
        $files = Input::file('images');
        $user = $model::where('sessionHandle', '=', $sId)->where('Name', '=', $name)->where('testId', '=', $id)->first();
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
                $pathToFile = $destinationPath . $name;
                $user->status = "File Sent";
                $user->filePath = $pathToFile;
                $success = $user->save();

                /*                $success = $user->savedReports()->create(array("filePath" => $name));*/
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
        $id = $input['testId'];
        $user = $model::where('sessionHandle', '=', $handle)->where('testId', '=', $id)->first();
        if (!isset($user) || count($user) == 0) {
            return array("code" => "1", "status" => "error", "message" => "User can't be found");
        } else {
            $file=$user['filePath'];

            $name = 'report';
            $headers = array(
                'Content-Type: application/pdf',
            );
            $destinationPath = public_path() . '/uploads/' . $file;
            return $file;

            return array("code" => "0", "status" => "success", "fielPath" => $file);


            return response()->download($destinationPath, $file, $headers);





        }
        return array("code" => "01", "status" => "error", "message" => "Report can't be found");


    }


    public static function request($input)
    {

        $model = new self();
        $model->sessionHandle = $input['sessionHandle'];
        $user = addUser::where('usrSessionHdl', '=', $input['sessionHandle'])->first();
        $name = $user['name'];
        $model->Name = $name;
        $model->testId = $input['testId'];
        $model->testName = $input['testName'];
/*        $model->testName = $input['keys'];*/

        $model->status = 'Pending';
        $dup = $model::where('sessionHandle', '=', $input['sessionHandle'])->where('testId', '=', $input['testId'])->first();
        if (!isset($dup) || count($dup) == 0) {
            $isSaved = $model->save();;
            if ($isSaved) {
                return array("code" => "0", "status" => "success", "message" => "Request successfully sent");

            } else {
                return array("code" => "1", "status" => "error", "message" => "Please try again");

            }

        } else {
            $dup->status = 'Pending';
            $isSaved = $dup->save();;
            if ($isSaved) {
                return array("code" => "0", "status" => "success", "message" => "Request successfully sent again");

            } else {
                return array("code" => "1", "status" => "error", "message" => "Please try again");

            }
        }


    }

}
