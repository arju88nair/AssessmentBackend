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

class assistance extends Eloquent
{
    protected $connection = "mongodb";
    protected $collection = "assistance";


    public static function requestAssistance($input)
    {
        $model = new self();
        $model->SessionHandle = $input['sessionHandle'];
        $model->testId = $input['testId'];
        $model->testId = $input['testName'];
        $model->status = 'Pending';
        $userNew = $model::where('SessionHandle', '=', $input['sessionHandle'])->where('testId', '=', $input['testId'])->first();
        $userPending = $model::where('SessionHandle', '=', $input['sessionHandle'])->where('testId', '=', $input['testId'])->where('status', '=', 'Pending')->first();
        $userDone = $model::where('SessionHandle', '=', $input['sessionHandle'])->where('testId', '=', $input['testId'])->where('status', '=', 'Coaching completed')->first();
        if (!isset($userNew) || count($userNew) == 0) {

            $isSaved = $model->save();
            if ($isSaved) {
                return array("code" => "0", "status" => "success", "message" => "Request successfully sent");
            }
            return array("code" => "1", "status" => "error", "message" => "Please try again");

        }
        if (isset($userPending) || count($userPending) != 0) {


            return array("code" => "1", "status" => "success", "message" => "Request already sent");

        }
        if (isset($userDone) || count($userDone) != 0) {

            return array("code" => "1", "status" => "success", "message" => "Coaching is already competed.");

        }

    }


}
