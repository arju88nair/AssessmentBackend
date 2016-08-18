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
use App\pdf\fpdf;


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


    public static function viewUsers()
    {
        $report = upload::all();
        $assistance = assistance::all();
        $users = addUser::orderBy('name', 'asc')->get();
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
        $session = $users['usrSessionHdl'];
        $test = savedtests::where('testId', '=', $id)->first();
        $chartDb = chart::where('testId', '=', $id)->where('session', '=', $session)->first();


        return View::Make('userTestDetails')->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('fulltest', $fulltest)->with('itema', $test)->with('data', $chartDb['axes'])->with('scores', $chartDb['scores']);

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

        $fulltest = questions::find('577f8ddac042f51ea0004f11');
        $test = savedtests::where('testId', '=', '577f8ddac042f51ea0004f11')->first();
        $pdf = \PDF::loadView('index', compact('fulltest'),compact('test'));
        return $pdf->output();
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

    public static function testA(){
        $fulltest = questions::find('577f8ddac042f51ea0004f11');

        return View::Make('index')->with('users', $fulltest);

    }
}


