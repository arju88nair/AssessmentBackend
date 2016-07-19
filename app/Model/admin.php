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

class admin extends Eloquent
{
    //

    protected $connection = 'mongodb';
    protected $collection = "adminUsers";


    public static function index($input)
    {
        $model = new self();
        $name = $input['name'];
        $role = $input['role'];
        $pwd = $input['password'];
        $model->name = $name;
        $model->role = $role;
        $model->password = $pwd;
        $isSave = $model->save();
        if ($isSave) {
            return "Successfully saved";
        } else {
            return "Unknown error occured";
        }


    }

    public static function login($input)
    {
        $model = new self();
        $name = $input['u'];
        $pwd = $input['p'];
        $role = $_POST['role'];
        $user = $model::where('name', '=', $name)->where('password', '=', $pwd)->first();
        if (!isset($user) || count($user) == 0) {
            return Redirect::to('login')->with('message', 'Login Failed');
        } else {

            $invitee = invite::all();
            $users = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test = questions::all();
            $report = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();


            return View::Make('dashboard')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);

        }
        /* if ($name == $user->name && $pwd == $user->password) {

             return Redirect::to('dashboard');


         }
         if ($name != $user->name && $pwd != $user->password) {

                 return "bye";
                 return Redirect::to('login')->with('message', 'Login Failed');;


             }*/
    }


    public static function testDetails($input)
    {

        $id = $_GET['action'];
        $fulltest = questions::find($id);
        $invitee = invite::all();
        $users = addUser::all();
        $savedtests = savedtests::getAnswers();
        $test = questions::all();
        $report = upload::where('status', '=', 'Pending')->get();
        $assistance = assistance::all();
        return View::Make('testDetails')->with('tests', $fulltest)->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);

    }

    public static function deleteTest($input)
    {
        $id = $_GET['action'];
        $delete = questions::find($id)->delete();

        if ($delete) {
            $invitee = invite::all();
            $users = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test = questions::all();
            $report = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();


            return Redirect::to('dashboardAction')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);

        } else {
            return "Please try again";
        }
    }


    public static function dashboard($input)
    {
        $invitee = invite::all();
        $users = addUser::all();
        $savedtests = savedtests::getAnswers();
        $test = questions::all();
        $report = upload::where('status', '=', 'Pending')->get();
        $assistance = assistance::all();
        return View::Make('dashboard')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);


    }


    public static function edit($input)
    {
        $id = $_GET['action'];
        $fulltest = questions::find($id);
        $invitee = invite::all();
        $users = addUser::all();
        $savedtests = savedtests::getAnswers();
        $test = questions::all();
        $report = upload::where('status', '=', 'Pending')->get();
        $assistance = assistance::all();
        return View::Make('newEdit')->with('tests', $fulltest)->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);


    }
<<<<<<< HEAD

    /* public static function addEdit($input)
     {
         $tests = $input['tests'];
         return $tests;
         $fulltest = questions::find($id);
         $invitee = invite::all();
         $users = addUser::all();
         $savedtests = savedtests::getAnswers();
         $test = questions::all();
         $report = upload::where('status', '=', 'Pending')->get();
         $assistance = assistance::all();
         return View::Make('newEdit')->with('tests', $fulltest)->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);


     }*/
=======
    public static function addEdit($input)
    {
        $tests = $input['tests'];
        return $tests;
        $fulltest = questions::find($id);
        $invitee = invite::all();
        $users = addUser::all();
        $savedtests = savedtests::getAnswers();
        $test = questions::all();
        $report = upload::where('status', '=', 'Pending')->get();
        $assistance = assistance::all();
        return View::Make('newEdit')->with('tests', $fulltest)->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);


    }
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432


    public static function viewUsers()
    {
        $report = upload::all();
        $assistance = assistance::all();
<<<<<<< HEAD
        $users = addUser::orderBy('name', 'asc')->get();
=======
        $users = savedtests::all();
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
        return View::Make('viewUsers')->with('users', $users)->with('report', $report)->with('assistance', $assistance);


    }

    public static function userTestDetails($input)
    {
        $id = $_GET['qId'];
        $uId = $_GET['uId'];
        $fulltest = questions::find($id);
        $report = upload::where('testId', '=', $id)->first();
        $assistance = assistance::where('testId', '=', $id)->first();
        $users = addUser::find($uId);
        $test = savedtests::where('testId', '=', $id)->first();

        return View::Make('userTestDetails')->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('fulltest', $fulltest)->with('itema', $test);

    }


    public static function addFeed($input)
    {
        $feed = feeds::all();
        $invitee = invite::all();
        $users = addUser::all();
        $savedtests = savedtests::getAnswers();
        $test = questions::all();
        $report = upload::where('status', '=', 'Pending')->get();
        $assistance = assistance::all();


        return View::Make('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);


    }

    public static function test()
    {

<<<<<<< HEAD
        define('API_ACCESS_KEY', 'AIzaSyCwBLJ-V5Ad7n0wh-n5i4QRKtN9d4XGWEs');
        $users = addUser::all();
        $array = array();
        foreach ($users as $items) {
            $push = $items['pushNotificationID'];
            array_push($array, $push);
        }
        $registrationIds = $array;

// prep the bundle
        $msg = array('message' => "Blah", "url" => "", "testName" => "", "testScore" => "", "testId" => "", "type" => "Test");

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
        echo $result;
=======
        if (isset($_POST['sb'])) {

            $path = public_path() . '/uploads/';

            $file = $_FILES['filetoupload']['name'];

            move_uploaded_file($_FILES['filetoupload']['tmp_name'], "$path/$file");

        }
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432

    }


    public static function notification()
    {
        $feed = feeds::all();
        $invitee = invite::all();
        $users = addUser::all();
        $savedtests = savedtests::getAnswers();
        $test = questions::all();
        $report = upload::where('status', '=', 'Pending')->get();
        $assistance = assistance::all();


        return View::Make('notifications')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);

    }
<<<<<<< HEAD

    public static function userDetails()
    {
        $id = $_GET['action'];
        $report = upload::where('status', '=', 'Pending')->get();
        $assistance = assistance::all();
        $user = addUser::find($id);
        $test = savedtests::where('_uId', '=', $id)->get();

        return View::Make('userDetails')->with('test', $test)->with('users', $user)->with('report', $report)->with('assistance', $assistance);


    }

    public static function search($input)
    {
        $search = $_POST['name'];
        $users = addUser::where('name', 'like', '%' . $search . '%')->orderBy('name', 'desc')->get();
        $report = upload::all();
        $assistance = assistance::all();
        return View::Make('viewUsers')->with('users', $users)->with('report', $report)->with('assistance', $assistance);
    }
}


=======
}

>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
