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

class comments extends Eloquent
{
    //
    /*For whoever may it concern,
"Long ago all classes livedtogether in harmony.Then everything changed when poor managment attacked.Only the Avatar ,the master of all classes
could stop them.But when the project needed him most, he vanished. A hundred commits passed.Me and my blackened soul  discovered a new Job. And although my progrmaming skills are great,
 he still has a lot to learn before he's ready to commit more. But I don't believe anyone can save this project."


But seriously,in the start all classes were well written.They came forth withtoo many changes and reverting back and everything which made this whle  code a living nightmare
 Sorry for whoever lays hand on this.

Best of luck,
Rain04


*/
    protected $connection = 'mongodb';
    protected $collection = "comments";



    public static function comments($input)
    {
        $model=new self();
        $session=$input['sessionHandle'];
        $uID=$input['uId'];
        $comment=$input['comment'];
        $user=addUser::where('usrSessionHdl','=',$session)->where('uniqueDeviceID','=',$uID)->first();
        if($user==null || $user==[])
        {
            return array("status" => "failure", "resultCode" => "1", "message" => "Can't find the user");
        }

        $userId=$user['userId'];
        if($userId == "" ||$userId == null)
        {
            $userId= "Guest";
        }
        $model->uID=$uID;
        $model->userId=$userId;
        $model->sessionHandle=$session;
        $model->status="New";
        $model->comments=htmlspecialchars($comment, ENT_QUOTES | ENT_SUBSTITUTE | ENT_DISALLOWED | ENT_HTML5, 'UTF-8');
        $isSaved=$model->save();
        if($isSaved)
        {
            return array("status" => "success", "resultCode" => "0", "message" => "Successfully added");

        }
        return array("status" => "failure", "resultCode" => "1", "message" => "Please try again later");




    }


}