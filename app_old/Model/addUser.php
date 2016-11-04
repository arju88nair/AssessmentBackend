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
        $location=$model->userLocation=$input['location'];
        $array_auth = ['Google', 'LinkedIn', 'Facebook', 'Email','Guest'];
        $array_plt = ['android', 'ios', 'webApp','Guest'];
        $array_device = ['smartphone', 'tablet', 'phablet','Guest'];
        $userTypes=['guest', 'normal'];
		$testEmailArray=['mail2appzoy@gmail.com','appzoytest@gmail.com','aditya.shankar@gmai.com','dheeraj@ipl.edu.in','Kaushik.Balasubramanian@ipl.edu.in','marya.wani@ipl.edu.in','padmaja.narsipur@ipl.edu.in','pshah@ipl.edu.in','rahul@ipl.edu.in','rahul@appzoy.com','arju88nair@gmail.com','ramanan@productleadership.com','rajesh@ipl.edu.in','rohan.krishna@ipl.edu.in','aditya.shankar@ipl.edu.in','jobin.john@ipl.edu.in','kavitha@appzoy.com','ramanan@ipl.edu.in','seema.joshi@ipl.edu.in','shwetha@clearlyblue.in','vishy@ipl.edu.in'];
		

         
        if (!in_array($authenticationType, $array_auth)) {
            return array("status" => "failure", "resultCode" => "1", "message" => "Incorrect authentication ");
        }
        if (!in_array($platform, $array_plt)) {
            return array("status" => "failure", "resultCode" => "1", "message" => "Incorrect platform ");
        }
        if (!in_array($device_model, $array_device)) {
            return array("status" => "failure", "resultCode" => "1", "message" => "Incorrect device ");
        }
        if($authenticationType=="Guest")
        {
            $name = $model->name = "";
            $couponGet = $model->coupon = "";
            $emailId = $model->userId = "";
            $authenticationType = $model->auth_type = "";
            $snsHandle = $model->snsHandle = "";
			$model->userType="Guest";
            $platform = $model->clientPlf = "";
            $model->imageUrl = "http://blog.ramboll.com/fehmarnbelt/wp-content/themes/ramboll2/images/profile-img.jpg";
            $device_model = $model->deviceType = $input['deviceType'];
            $model->appVersion = $input['appVersion'];
            $model->uniqueDeviceID = $input['uniqueDeviceID'];
            $push = $model->pushNotificationID = $input['pushNotificationID'];
            $location=$model->userLocation=$input['location'];
            $array_auth = ['Google', 'LinkedIn', 'Facebook', 'Email'];
            $array_plt = ['android', 'ios', 'webApp'];
            $array_device = ['smartphone', 'tablet', 'phablet'];
            $userTypes=['guest', 'normal'];
            if(!isset($input['uniqueDeviceID'])||$input['uniqueDeviceID']==""||$input['uniqueDeviceID']==null)
            {
                return array("status" => "failure", "resultCode" => "1", "message" => "Incorrect Device Id ");
            }
            else{
                $users = $model::where('auth_type', '=', $authenticationType)->where('uniqueDeviceID','=',$input['uniqueDeviceID'])->first();
                if (!isset($users) || count($users) == 0) {
					$model->liked = array();
                    $model->feedCount=0;
                    $uniqueID = $model->usrSessionHdl="Guest";
                    $model->save();
                    $date= $model['created_at'];
                    return array("status" => "success", "resultCode" => "1", "userType" => "Guest", "message" => "New user created", "sessionHandle" => "Guest" ,'feedCount'=>0,'createdAt'=>$date);
                }
                else{
                    if($users['feedCount']>=10)
                    {
                        return array("status" => "success", "resultCode" => "1", "userType" => "Guest", "message" => "Access invalid", "sessionHandle" => "Guest",'feedCount'=>$users['feedCount'],'createdAt'=>$users['created_at']);
                    }
                    else
                    {

                        return array("status" => "success", "resultCode" => "1", "userType" => "Guest", "message" => "User Already Present", "sessionHandle" => "Guest",'feedCount'=>$users['feedCount'],'createdAt'=>$users['created_at']);


                    }


                }
            }

        }
        else {



            $uniqueID = $model->usrSessionHdl = uniqid();
            $str = strtotime('now');
            $now = date($str);
            $coupons = coupon::where('Coupon', '=', $couponGet)->where('Date', '>', $now)->get();
            $users = $model::where('userId', '=', $emailId)->take(1)->get();
			$idUser=$model::where('uniqueDeviceID', '=', $input['uniqueDeviceID'])->first();
			


            if (!isset($users) || count($users) == 0) {
                $model->liked = array();
					if (in_array($emailId, $testEmailArray)) {
					$model->userType="Test";
					$userType="Test";
					}
					else{
						$model->userType="Normal";
						$userType="Normal";
					}
                if (!isset($coupons) || count($coupons) == 0 || $couponGet == "") {
					$model->pushNotificationID = $input['pushNotificationID'];
                    $model->corporateName = "";
                    $model->save();
                    return array("status" => "success", "resultCode" => "11", "userType" => $userType, "message" => "New user created", "sessionHandle" => $uniqueID,'feedCount'=>0);

                } else {
					$model->pushNotificationID = $input['pushNotificationID'];
                    $coupon = coupon::where('Coupon', '=', $couponGet)->first();
                    $com_name = $coupon['Name'];
                    $model->corporateName = $com_name;
                    $model->save();
                    return array("status" => "success", "resultCode" => "12", "userType" => $userType, "message" => "New user created", "sessionHandle" => $uniqueID,'feedCount'=>0);
                }


            } else {
				if (in_array($emailId, $testEmailArray)) {
					$model->userType="Test";
					$userType="Test";
					}
					else{
						$model->userType="Normal";
						$userType="Normal";
					}
                foreach ($users as $user) {

                    $userHandle = $user->usrSessionHdl;

                }
                if (!isset($coupons) || count($coupons) == 0 || $couponGet == "") {

                    $new = $model::where('userId', '=', $emailId)->first();
                    $new->pushNotificationID = $push;
                    $new->name = $input['userName'];
                    $new->auth_type = $input['authType'];
                    $new->snsHandle = $input['password'];
                    $new->clientPlf = $input['clientPlf'];
                    $new->imageUrl = $input['imageUrl'];
                    $new->deviceType = $input['deviceType'];
                    $new->appVersion = $input['appVersion'];
                    $new->uniqueDeviceID = $input['uniqueDeviceID'];
                    $new->userLocation = $input['location'];
                    $new->corporateName = "";
                    $new->save();

                    return array("status" => "success", "resultCode" => "1", "userType" => $userType, "message" => "User already present", "sessionHandle" => $userHandle,'feedCount'=>0);


                } else {
                    $new = $model::where('userId', '=', $emailId)->first();
                    $new->pushNotificationID = $push;
                    $new->name = $input['userName'];
                    $new->name = $input['userName'];
                    $new->auth_type = $input['authType'];
                    $new->snsHandle = $input['password'];
                    $new->clientPlf = $input['clientPlf'];
                    $new->imageUrl = $input['imageUrl'];
                    $new->deviceType = $input['deviceType'];
                    $model->userLocation = $input['location'];
                    $new->appVersion = $input['appVersion'];
                    $new->uniqueDeviceID = $input['uniqueDeviceID'];
                    $coupon = coupon::where('Coupon', '=', $couponGet)->first();
                    $com_name = $coupon['Name'];
                    $new->corporateName = $com_name;
                    $new->save();


                    return array("status" => "success", "resultCode" => "1", "userType" => $userType, "message" => "User already present", "sessionHandle" => $userHandle,'feedCount'=>0);
                }

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


    /*public function savedtests()
    {

        return $this->embedsMany('App\Model\savedtests');
    }*/

    public function savedReports()
    {
        return $this->embedsMany('App\Model\file');
    }


    /* public static function addanswers($input)

     {
         $model = new self();
         $array = array();
         $session = $input['sessionHandle'];
         $user = $model::where('usrSessionHdl', '=', $session)->first();
         $keys = $input['keys'];
         $id = $input['testId'];
         $name=$input['testName'];
         $score = $input['overallScore'];
         if (!isset($user) || count($user) == 0) {
             return array("code" => "1", "status" => "error", "message" => "Session handle can't be found");
         } else {
             $test = $user->savedtests()->create(array("testId" => $id,"testName"=>$name, "score" => $score, "tests" => $keys));
             if ($test) {
                 return array("code" => "0", "status" => "Successfully added");

             } else {
                 return array("code" => "1", "status" => "error");
             }
         }


     }*/


    public static function upload($input)
    {
        $handle = $input['userHandle'];
        $name = Input::get('username');
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
                $name = Input::get('username') . "-" . $filename;

                $file->move($destinationPath, $name);
                $success = $user->savedReports()->create(array("filePath" => $name));
                $pathToFile = $destinationPath . $name;
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


    public function invitees()
    {
        return $this->embedsMany('App\Model\invitees');
    }


    


    public static function gcm($file, $id, $name,$testName,$testScore,$testId)
    {

        define('API_ACCESS_KEY', 'AIzaSyCwBLJ-V5Ad7n0wh-n5i4QRKtN9d4XGWEs');
        $registrationIds = array($id);

// prep the bundle
        $msg = array('message' => 'Hello ' . $name . ',your report is ready for download!', "url" => $file,"testName"=>$testName,"testScore"=>$testScore,"testId"=>$testId,"type"=>"Report");

        $fields = array
        (
            'registration_ids' => $registrationIds,
            'data' => $msg
        );

        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;


    }


    public static function enterVoucher($input)
    {
        $session = $input['sessionHandle'];
        $code = $input['couponCode'];
        $user = addUser::where('usrSessionHdl', '=', $session)->first();
        if (!isset($user) || count($user) == 0) {
            return array("status" => "error", "resultCode" => "1", "message" => "Incorrect session handle received ");
        } else {

            if (!isset($code) || count($code) == 0 || $code == "") {
                $user->corporateName = "";
                $user->save();
                return array("status" => "success", "resultCode" => "11", "userType" => "Free access granted", "message" => "New user created", "sessionHandle" => $session);

            } else {
                $coupon = coupon::where('Coupon', '=', $code)->first();
                if (!isset($coupon) || count($coupon) == 0 || $coupon == "") {
                    return array("status" => "error", "resultCode" => "00", "message" => "Invalid coupon code");

                } else {
                    $com_name = $coupon['Name'];
                    $user->corporateName = $com_name;
                    $user->save();
                    return array("status" => "success", "resultCode" => "1", "userType" => "$com_name access granted", "message" => "User already present", "sessionHandle" => $session);

                }

            }


        }

    }

    public static function testGcm($testId)
    {

        define('API_ACCESS_KEY', 'AIzaSyCwBLJ-V5Ad7n0wh-n5i4QRKtN9d4XGWEs');
        $users = addUser::all();
        $array = array();
        foreach ($users as $items) {
            $push = $items['pushNotificationID'];
            array_push($array,$push);
        }
        $registrationIds =$array;

// prep the bundle
        $msg = array('message' => $testId, "url" => "","testName"=>"","testScore"=>"","testId"=>"","type"=>"Test");

        $fields = array
        (
            'registration_ids' => $registrationIds,
            'data' => $msg
        );

        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;


    }
    public static function feedGcm($title,$id)
    {

        define('API_ACCESS_KEY', 'AIzaSyCwBLJ-V5Ad7n0wh-n5i4QRKtN9d4XGWEs');
        $users = addUser::all();
        $array = array();
        foreach ($users as $items) {
            $push = $items['pushNotificationID'];
            array_push($array,$push);
        }
        $registrationIds =$array;

// prep the bundle
        $msg = array('message' => $title, "url" => "","testName"=>"","testScore"=>"","testId"=>"","type"=>"Feed","id"=>$id);

        $fields = array
        (
            'registration_ids' => $registrationIds,
            'data' => $msg
        );

        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;


    }

}

