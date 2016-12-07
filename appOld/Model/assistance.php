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
        $model                = new self();
        $model->SessionHandle = $input['sessionHandle'];
        $model->testId        = $input['testId'];
        $model->testName      = $input['testName'];
        $model->status        = 'Pending';
        $user                 = addUser::where('usrSessionHdl', '=', $input['sessionHandle'])->first();
        if (!isset($user) || count($user) == 0) {
            
            return array(
                "code" => "1",
                "status" => "error",
                "message" => "User couldn't be found"
            );
        } //!isset($user) || count($user) == 0
        $userNew     = $model::where('SessionHandle', '=', $input['sessionHandle'])->where('testId', '=', $input['testId'])->first();
        $userPending = $model::where('SessionHandle', '=', $input['sessionHandle'])->where('testId', '=', $input['testId'])->where('status', '=', 'Pending')->first();
        $userDone    = $model::where('SessionHandle', '=', $input['sessionHandle'])->where('testId', '=', $input['testId'])->where('status', '=', 'Coaching completed')->first();
        if (!isset($userNew) || count($userNew) == 0) {
            
            $isSaved = $model->save();
            if ($isSaved) {
                return array(
                    "code" => "0",
                    "status" => "success",
                    "message" => "Request for 1-1 coaching registered.IPL staff will get in touch with you"
                );
            } //$isSaved
            return array(
                "code" => "1",
                "status" => "error",
                "message" => "Please try again"
            );
            
        } //!isset($userNew) || count($userNew) == 0
        if (isset($userPending) || count($userPending) != 0) {
            
            
            return array(
                "code" => "1",
                "status" => "success",
                "message" => "Request for 1-1 coaching is already registered.IPL staff will get in touch with you"
            );
            
        } //isset($userPending) || count($userPending) != 0
        if (isset($userDone) || count($userDone) != 0) {
            
            return array(
                "code" => "1",
                "status" => "success",
                "message" => "1-1 Coaching is already competed."
            );
            
        } //isset($userDone) || count($userDone) != 0
        
    }
    
    
}
