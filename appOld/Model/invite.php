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

class invite extends Eloquent
{
    //

    protected $connection = 'mongodb';
    protected $collection = "invite";


    public static function invite($input)
    {
        $model = new self();
        $userHandle = $input['sessionHandle'];
        $user = addUser::where('usrSessionHdl', '=', $userHandle)->first();
        $name = $input['name'];
        $model->name = $name;
        $model->sessionHandle = $userHandle;
        $model->testId = $input['testId'];
        $invitees = $input['invitees'];
        $model->invitees = $invitees;
        if (!isset($user) || count($user) == 0) {
            return array("code" => "1", "status" => "error", "message" => "User can't be found");
        } else {

            $alreadySaved = $model::where('sessionHandle', '=', $userHandle)->where('testId', '=', $input['testId'])->first();
            if (isset($alreadySaved) || count($alreadySaved) != 0) {
                /*foreach ($invitees as $invite) ;
                {
                    return $invite;
                }
                $invitees = $alreadySaved['invitees'];*/
                return array("code" => "1", "status" => "error", "message" => "Already invited");
            } else {

                $isSaved = $model->save();
                if ($isSaved) {
                    return array("code" => "0", "status" => "success", "message" => "Invitees saved");
                } else {
                    return array("code" => "1", "status" => "error", "message" => "Some error occured");

                }

            }


        }
    }


    public static function getInvitees($input)
    {

        $model = new self();
        $userHandle = $input['sessionHandle'];
        $id=$input['testId'];
        $user = $model::where('sessionHandle', '=', $userHandle)->where('testId', '=', $id)->first();
        $invitees=$user['invitees'];
        $array=array();

        foreach($invitees as $invite){
            $email=$invite['emailId'];
            $array[]=$email;
        }

        if(!isset($array) || count($array)==0){
            return array("code" => "1", "status" => "error", "message" => "No new invitees");

        }
        return array("code" => "0", "status" => "success", "invited" => $array);
    }


}

