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

class addUser extends Eloquent
{
    //

    protected $connection = 'mongodb';
    protected $collection = "addedusers";


    public static function insert($input)
    {

        $array = array();
        $model = new self();
        $alldocs = questions::all();
        echo $alldocs;
        foreach ($alldocs as $item) {
            $testId = $item->_id;
            echo $testId;
            $testName = $item->testName;
            array_push($array, $testId);

        }
        $name = $input['name'];
        $users = $model::where('name', '=', $name)->first();
        if (!isset($users) || count($users) == 0) {
            return array("code" => "0");
        } else {
            $users->arrayName = $array;
            /*            return $users;*/
        }


    }

    public static function getUser()
    {
        $model = new self();
        $all = $model::all();
        foreach ($all as $tst) {
            $tests = $tst["savedtests"];
            unset($tst->savedtests);
            $tst->savedtests = $tests;
        }

        return $all;
    }


    public static function userCheck($input)
    {
        $model = new self();
        $userModel = addUser::all();
        $couponModel = coupon::getCoupon();
        $name = $model->name = $input['userName'];
        $couponGet = $model->coupon = $input['coupon'];
        $emailId = $model->userId = $input['userID'];
        $authenticationType = $model->auth_type = $input['authType'];
        $snsHandle = $model->snsHandle = $input['password'];
        $platform = $model->clientPlf = $input['clientPlf'];
        $model->imageUrl = $input['imageUrl'];
        $device_model = $model->deviceType = $input['deviceType'];
        $model->appVersion = $input['appVersion'];
        $model->uniqueDeviceID = $input['uniqueDeviceID'];
        $push = $model->pushNotificationID = $input['pushNotificationID'];
        $uniqueID = $model->usrSessionHdl = uniqid();
        $array_auth = ['Google', 'LinkedIn', 'Facebook', 'Email'];
        $array_plt = ['android', 'ios', 'webApp'];
        $array_device = ['smartphone', 'tablet', 'phablet'];


        if (!in_array($authenticationType, $array_auth)) {
            return array("status" => "failure", "resultCode" => "1", "message" => "Incorrect authentication ");
        }
        if (!in_array($platform, $array_plt)) {
            return array("status" => "failure", "resultCode" => "1", "message" => "Incorrect platform ");
        }
        if (!in_array($device_model, $array_device)) {
            return array("status" => "failure", "resultCode" => "1", "message" => "Incorrect device ");
        }


        $str = strtotime('now');
        $now = date($str);
        $coupons = coupon::where('Coupon', '=', $couponGet)->where('Date', '>', $now)->get();
        $users = $model::where('userId', '=', $emailId)->take(1)->get();

        if (!isset($users) || count($users) == 0) {

            if (!isset($coupons) || count($coupons) == 0 || $couponGet == "") {
                $model->save();
                return array("status" => "success", "resultCode" => "11", "userType" => "Free access", "message" => "New user created", "sessionHandle" => $uniqueID);


            } else {
                $model->save();
                return array("status" => "success", "resultCode" => "12", "userType" => "Corporate access", "message" => "New user created", "sessionHandle" => $uniqueID);
            }


        } else {
            foreach ($users as $user) {

                $userHandle = $user->usrSessionHdl;

            }
            if (!isset($coupons) || count($coupons) == 0 || $couponGet == "") {

                $new = $model::where('userId', '=', $emailId)->first();
                $new->pushNotificationID = $push;
                $new->save();

                return array("status" => "success", "resultCode" => "1", "userType" => "Free access", "message" => "User already present", "sessionHandle" => $userHandle);


            } else {
                $new = $model::where('userId', '=', $emailId)->first();
                $new->pushNotificationID = $push;
                $new->save();

                return array("status" => "success", "resultCode" => "1", "userType" => "Corporate access", "message" => "User already present", "sessionHandle" => $userHandle);
            }

        }


    }


    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }


    public static function test($input)
    {
        $model = new self();
        $users = $model::count();
        echo $users;

    }


    public function savedtests()
    {

        return $this->embedsMany('App\Model\savedtests');
    }

    public function savedReports()
    {
        return $this->embedsMany('App\Model\file');
    }


    public static function addanswers($input)

    {
        $model = new self();
        $array = array();
        $session = $input['sessionHandle'];
        $user = $model::where('usrSessionHdl', '=', $session)->first();
        $keys = $input['keys'];
        $id = $input['testId'];
        $score = $input['overallScore'];
        if (!isset($user) || count($user) == 0) {
            return array("code" => "1", "status" => "error", "message" => "Session handle can't be found");
        } else {
            $test = $user->savedtests()->create(array("testId" => $id, "score" => $score, "tests" => $keys));
            if ($test) {
                return array("code" => "0", "status" => "Successfully added");

            } else {
                return array("code" => "1", "status" => "error");
            }
        }


    }


    public static function upload($input)
    {
        $handle=$input['userHandle'];
        $name = Input::get('username');
        $files = Input::file('images');
        $user = addUser::where('userId', '=', $name)->first();
        if (!isset($user) || count($user) == 0) {
            return "No user found";
        }
        if(!Input::hasFile('images')){
            return "No file found";
        }
        if (Input::hasFile('images')) {
            foreach ($files as $file) {
                $destinationPath = public_path() . '/uploads/';
                $filename = $file->getClientOriginalName();
                $name =  Input::get('username') ."-" .$filename;

                $file->move($destinationPath, $name);
                $success = $user->savedReports()->create(array("filePath" => $name));
                $pathToFile=$destinationPath.$name;
                if ($success) {
                    return response()->download($pathToFile);
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



    public function invitees(){
        return $this->embedsMany('App\Model\invitees');
    }




   /* public static function invite($input)
    {
        $model= new self();
        $userHandle=$input['sessionHandle'];
        $user=$model::where('usrSessionHdl','=',$userHandle)->first();

        $invitees=$input['invitees'];
        if(!isset($user) || count($user)==0){
            return array("code" => "1", "status" => "error", "message" => "User can't be found");
        }

        foreach($invitees as $item){
            $array=array();
            $main=array();

            $array['name']=$item['name'];
            $array['emailId']=$item['emailId'];





            $saved=$user->invitees()->create($array);

        }
        if(!isset($saved) || count($saved)==0){
            return array("code" => "1", "status" => "error", "message" => "User can't be found");

        }
        else{
            return array("code" => "0", "status" => "success", "message" => "Invitees saved");
        }






    }*/

}

