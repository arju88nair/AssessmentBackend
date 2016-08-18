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
        $sId = Input::get('sessionHandle');
        $tName=Input::get('testName');
        $tScore=Input::get('Score');
        $tId=Input::get('testId');
        $user = $model::where('sessionHandle', '=', $sId)->first();
        $files = Input::file('images');
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
                $name = $user['Name'] . "@" . $filename;
                $file->move($destinationPath, $name);
                $pathToFile = $destinationPath . $name;
                $user->status = "File Sent";
                $user->filePath = $pathToFile;
                $success = $user->save();

                /*                $success = $user->savedReports()->create(array("filePath" => $name));*/
                if ($success) {

                    $addUser = addUser::where('usrSessionHdl', '=', $sId)->first();
                    $nameUser = $addUser['name'];
                    $id = $addUser['pushNotificationID'];
                    $invitee = invite::all();
                    $users = addUser::all();
                    $savedtests = savedtests::getAnswers();
                    $test = questions::all();
                    $report = upload::all();
                    $assistance = assistance::all();
                    $string = "/var/www/html/Assessment/public";
                    $path = 'http://' . $_SERVER['HTTP_HOST'] . str_replace($string, '', $pathToFile);
                    return $path;
                    $gcm = addUser::gcm($path, $id, $nameUser,$tName,$tScore,$tId);
                    return $gcm;


                    return View::Make('dashboard')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);


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
            $file = $user['filePath'];

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
        $model->score = $input['score'];
        $model->testName = $input['testName'];

        $model->imageUrl = $user['imageUrl'];
        $model->_uId = $user['_id'];
        /*        $model->testName = $input['keys'];*/

        $model->status = 'Pending';
 		$test = savedtests::where('testId', '=', $input['testId'])->where('_uId','=','576cec60a94ff4271d47d4d8')->first();
        $users = addUser::find('576cec60a94ff4271d47d4d8');
			$pdf = \PDF::loadView('chart', compact('user'));
		$saved=file_put_contents("reports/my_document.pdf", $pdf->output()); 
		if($saved){
					$file="http://ec2-52-33-112-148.us-west-2.compute.amazonaws.com/reports/my_document.pdf";

		}
        $dup = $model::where('sessionHandle', '=', $input['sessionHandle'])->where('testId', '=', $input['testId'])->first();
        if (!isset($dup) || count($dup) == 0) {
            $isSaved = $model->save();;
            if ($isSaved) {
				  $msg = array('status' => 'success','message' => 'Hello ' . $name . ',your report is ready for download!', "url" => $file,"testName"=>$input['testName'],"testScore"=>$input['score'],"testId"=>$input['testId'],"type"=>"Report");
return $msg;
                return array("code" => "0", "status" => "success", "message" => "Request successfully sent");

            } else {
                return array("code" => "1", "status" => "error", "message" => "Please try again");

            }

        } else {
            $dup->status = 'Pending';
            $isSaved = $dup->save();;
            if ($isSaved) {
				  $msg = array('status' => 'success','message' => 'Hello ' . $name . ',your report is ready for download!', "url" => $file,"testName"=>$input['testName'],"testScore"=>$input['score'],"testId"=>$input['testId'],"type"=>"Report");
return $msg;
                return array("code" => "0", "status" => "success", "message" => "Request successfully sent again");

            } else {
                return array("code" => "1", "status" => "error", "message" => "Please try again");

            }
        }


    }

}
