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
            $name= $user->name;
            $email=$user->userId;
            $model->name=$name;

            $model->userHandle=$userHandle;
            $invitees = $input['invitees'];
            $model->invitees=$invitees;

            if (!isset($user) || count($user) == 0) {
                return array("code" => "1", "status" => "error", "message" => "User can't be found");
            }

            $isSaved=$model->save();
            if($isSaved){
                return array("code" => "0", "status" => "success", "message" => "Invitees saved");
            }
            else{
                return array("code" => "1", "status" => "error", "message" => "Some error occured");

            }


        }


}

