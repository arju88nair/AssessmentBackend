<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Date;
use Jenssegers\Mongodb\Schema\Blueprint;
use App\Model\Tests;

class savedtests extends Eloquent
{
    //

    protected $connection="mongodb";
    protected $collection="savedtests";
    protected $fillable=['tests','testId',"testName","score"];



    public static function addanswers($input)
    {

        $model = new self();
        $array = array();
        $session = $input['sessionHandle'];
        $model->sessionHandle=$session;
        $user = addUser::where('usrSessionHdl', '=', $session)->first();
        $model->keys=$input['keys'];
        $model->testId=$input['testId'];
        $model->testName=$input['testName'];
        $model->testCity=$input['city'];
        $model->duration=$input['timeTaken'];
        $model->score= $input['overallScore'];
        if (!isset($user) || count($user) == 0) {
            return array("code" => "1", "status" => "error", "message" => "Session handle can't be found");
        } else {
            $model->name=$user['name'];
            $model->_uId=$user['_id'];

            $model->imageUrl=$user['imageUrl'];

            $test = $model->save();
            if ($test) {
                return array("code" => "0", "status" => "Successfully added");

            } else {
                return array("code" => "1", "status" => "error");
            }
        }
    }




    public static function getAnswers(){

        $model=new self();
        $all= $model::all();
        return $all;

    }

}
