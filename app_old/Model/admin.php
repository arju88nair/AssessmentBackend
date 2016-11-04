<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Date;
use Infogram\InfogramRequest;
use Infogram\RequestSigningSession;
use Jenssegers\Mongodb\Schema\Blueprint;
use App\Model\Tests;
use View;
use Redirect;
use Input;
use DateTime;

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
        $model->$input['userName'];
        $model->name = $name;
        $model->role = $role;
        $model->password = $pwd;
        $isSave = $model->save();
        if ($isSave) {
            return "Successfully saved";
        } //$isSave
        else {
            return "Unknown error occured";
        }


    }

    public static function login($input)
    {
        $model = new self();
        $name = $input['u'];
        $model = admin::where('name', '=', $name)->first();
        $pwd = $input['p'];
        $role = $_POST['role'];
        $user = self::where('name', '=', $name)->where('password', '=', $pwd)->first();
        $epoch = time();
        $dt = new DateTime("@$epoch"); // convert UNIX timestamp to PHP DateTime
        $time = $dt->format('Y-m-d H:i:s');
        user::query()->delete();
        $db = new user();
        $db->delete();
        $db->user = $name;
        $db->save();
        if (!isset($user) || count($user) == 0) {
            return Redirect::to('loginAdmin')->with('message', 'Login Failed');
        } //!isset($user) || count($user) == 0
        else {

            $model['status'] = "login";
            $model->save();
            $user->time = $time;

            /*  $invitee = invite::all();
            $users = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test = questions::all();
            $report = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();
            

            return View::Make('dashboard')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);
            */
            $array = array();
            $admin = admin::all();

            /* $liked=like::where('feedId','=',$feedid)->get(); */
            /* 			return count($liked);
             */
            foreach ($admin as $ad) {
                array_push($array, $ad['name']);
            } //$admin as $ad
            $feeds = feeds::all();
            $invitee = invite::all();
            $users = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test = questions::all();
            $report = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();
            $feed=array();
            foreach($feeds as $item)
            {
                array_push($feed,$item);
            }
            $feed= array_reverse($feed);

            return View::Make('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed)->with('tag1', $array)->with('user', $name)->with('tag','All')->with('tag2','All');


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

            $array = array();
            $admin = admin::all();

            /* $liked=like::where('feedId','=',$feedid)->get(); */
            /* 			return count($liked);
             */
            foreach ($admin as $ad) {
                array_push($array, $ad['name']);
            } //$admin as $ad
            $feed = feeds::all();
            $invitee = invite::all();
            $users = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test = questions::all();
            $report = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();

            return View::Make('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed)->with('tag1', $array);


            /*  $invitee = invite::all();
            $users = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test = questions::all();
            $report = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();
            
            
            return Redirect::to('dashboardAction')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);
            */
        } //$delete
        else {
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

        $feed = feeds::all();
        $invitee = invite::all();
        $users = addUser::all();
        $savedtests = savedtests::getAnswers();
        $test = questions::all();
        $report = upload::where('status', '=', 'Pending')->get();
        $assistance = assistance::all();

        return View::Make('dashboard')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);


        /* $invitee = invite::all();
        $users = addUser::all();
        $savedtests = savedtests::getAnswers();
        $test = questions::all();
        $report = upload::where('status', '=', 'Pending')->get();
        $assistance = assistance::all();
        return View::Make('dashboard')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);
        
        */
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


    public static function viewUsers()
    {

        $report = upload::all();
        $assistance = assistance::all();
        $users = addUser::orderBy('name', 'asc')->get();
        $save = "";
        return View::Make('viewUsers')->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('saved', $save);


    }

    public static function userTestDetails($input)
    {
        $id = $_GET['qId'];
        $uId = $_GET['uId'];
        $tId = $_GET['tId'];
        $fulltest = questions::find($id);
        $report = upload::where('testId', '=', $id)->first();
        $assistance = assistance::where('testId', '=', $id)->first();
        $users = addUser::find($uId);
        $session = $users['usrSessionHdl'];
        $test = savedtests::where('testId', '=', $id)->where('_uId', '=', $uId)->where('_id', '=', $tId)->first();
        $chartDb = chart::where('testId', '=', $id)->where('session', '=', $session)->first();
        return View::Make('userTestDetails')->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('fulltest', $fulltest)->with('itema', $test)->with('data', $chartDb['axes'])->with('scores', $chartDb['scores'])->with('userId', $uId)->with('testId', $id);

    }


    public static function addFeed($input)
    {
        $db = user::first();
        $user = $db['user'];
        $array = array();
        $admin = admin::all();
        foreach ($admin as $ad) {
            array_push($array, $ad['name']);
        } //$admin as $ad

        $feeds = feeds::all();
        $invitee = invite::all();
        $users = addUser::all();
        $savedtests = savedtests::getAnswers();
        $test = questions::all();
        $report = upload::where('status', '=', 'Pending')->get();
        $assistance = assistance::all();
$feed=array();
        foreach($feeds as $item)
        {
            array_push($feed,$item);
        }
        $feed= array_reverse($feed);
        return View::Make('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed)->with('tag1', $array)->with('user', $user)->with('tag','All')->with('tag2','All');

    }

    public static function test()
    {
        $id = $_GET['id'];
        $uId = $_GET['uId'];
        $fulltest = questions::find($id);
        $test = savedtests::where('testId', '=', $id)->where('_uId', '=', $uId)->first();
        $users = addUser::find($uId);
        $pdf = \PDF::loadView('index', compact('fulltest'), compact('test'), compact('users'));

        /*  $saved=file_put_contents("audio/my_document.pdf", $pdf->output());  */
        return $pdf->stream();
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
        $page = "search";
        $users = addUser::where('name', 'like', '%' . $search . '%')->orderBy('name', 'desc')->get();
        $save = savedtests::where('testName', 'like', '%' . $search . '%')->orWhere('name', 'like', '%' . $search . '%')->orderBy('testName', 'desc')->get();
        $report = upload::all();
        $assistance = assistance::all();
        return View::Make('search')->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('saved', $save)->with('page', $page)->with('search', $search);
    }

    public static function chartPdf($input)
    {

        $test = savedtests::where('testId', '=', '579c637ea94ff4550f1122b2')->where('_uId', '=', '576cec60a94ff4271d47d4d8')->first();
        $user = addUser::find('579f227da94ff467d85e54ba');

        $pdf = \PDF::loadView('chart', compact('user'));

        /*  $saved=file_put_contents("audio/my_document.pdf", $pdf->output());  */
        /* return $pdf->stream(); */
        $saved = file_put_contents("reports/my_document.pdf", $pdf->output());
        if ($saved) {
            return "i";
        } //$saved
        else {
            return "no";
        }
    }


    public static function testView()
    {
        $test = savedtests::orderBy('updated_at', 'desc')->take(50)->get();
        $report = upload::all();
        $assistance = assistance::all();
        return View::Make('testView')->with('test', $test)->with('report', $report)->with('assistance', $assistance);
    }


    public static function viewFeed()
    {

        $use = $_POST['user'];
        if ($_POST['button'] == "filter") {
            $array = array();
            $admin = admin::all();
            foreach ($admin as $ad) {
                array_push($array, $ad['name']);
            } //$admin as $ad
            $tag = $_POST['Category'];
            $owner = $_POST['owner'];

            if ($tag == "All" && $owner == "All") {
                $feeds = feeds::all();
            } //$tag == "All" && $owner == "All"
            if ($tag != "All" && $owner == "All") {
                $feeds = feeds::where('category', '=', $tag)->get();
            } //$tag != "All" && $owner == "All"
            if ($tag == "All" && $owner != "All") {
                $feeds = feeds::where('feedOwner', '=', $owner)->get();
            } //$tag == "All" && $owner != "All"
            if ($tag != "All" && $owner != "All") {
                $feeds = feeds::where('category', '=', $tag)->where('feedOwner', '=', $owner)->get();
            } //$tag != "All" && $owner != "All"
            $invitee = invite::all();
            $users = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test = questions::all();
            $report = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();

            $feed=array();
            foreach($feeds as $item)
            {
                array_push($feed,$item);
            }
            $feed= array_reverse($feed);
            return View::Make('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed)->with('tag', $tag)->with('tag1', $array)->with('tag2', $owner)->with('user', $use);

        } else {
            $array = array();
            $admin = admin::all();
            foreach ($admin as $ad) {
                array_push($array, $ad['name']);
            } //$admin as $ad

            $tag = "All";
            $owner = "All";
            $feeds = feeds::orderBy('likeCount', 'desc')->get();
            $invitee = invite::all();
            $users = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test = questions::all();
            $report = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();
            $feed=array();
            foreach($feeds as $item)
            {
                array_push($feed,$item);
            }
            $feed= $feeds;

            return View::Make('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed)->with('tag', $tag)->with('tag1', $array)->with('tag2', $owner)->with('user', $use);


        }

    }


    public static function setFeed()
    {
        $main=mainFeed::all();

        if(count($main)==0||!isset($main)){
            $array = array();
            $excepted = array();
            $allFeeds = feeds::all();
            foreach ($allFeeds as $feed) {
                $date = self::dated($feed['updated_at']);
                if ($date <= 1) {
                    array_push($array, $feed);
                } else {
                    array_push($excepted, $feed);
                }
            }
            $array = array_reverse($array);
            $excepted = array_reverse($excepted);

            return View::make('setFeed')->with('main', $array)->with('other', $excepted);
        }
        else{

            $mainId=array();
            $array=mainFeed::all();
            $excepted=array();
            $feeds=feeds::all();
            foreach($array as $main){
                array_push($mainId,$main['_id']);
            }
            foreach($feeds as $feed){

                if(!in_array($feed['_id'],$mainId)){
                    array_push($excepted,$feed);
                }
            }
            return View::make('setFeed')->with('main', $array)->with('other', $excepted);
        }

    }

    public static function testFeed()
    {
        $main=mainFeed::all();

        if(count($main)==0||!isset($main)){
            $array = array();
            $excepted = array();
            $allFeeds = feeds::all();
            foreach ($allFeeds as $feed) {
                $date = self::dated($feed['updated_at']);
                if ($date <= 1) {
                    array_push($array, $feed);
                } else {
                    array_push($excepted, $feed);
                }
            }
            $array = array_reverse($array);
            $excepted = array_reverse($excepted);

            return View::make('test')->with('main', $array)->with('other', $excepted);
        }
        else{

            $mainId=array();
            $array=mainFeed::all();
            $excepted=array();
            $feeds=feeds::all();
            foreach($array as $main){
                array_push($mainId,$main['_id']);
            }
            foreach($feeds as $feed){

                if(!in_array($feed['_id'],$mainId)){
                    array_push($excepted,$feed);
                }
            }
            return View::make('test')->with('main', $array)->with('other', $excepted);
        }

    }

    public static function testar($a, $b, $c)
    {
        $d = $b;
        foreach ($c as $t) {
            if (strcmp($t, $b) == 0) {

                return $a;

            }

        }

    }

    private static function dated($date)
    {
        $now = time(); // or your date as well
        $your_date = strtotime($date);
        $datediff = $now - $your_date;

        return floor($datediff / (60 * 60 * 24));
    }

    public static function saveSetFeed()
    {
        $ids = $_POST['ids'];
        $ids = explode(",", $ids);
        $arr = array();
        $allFeeds = feeds::all();
        foreach ($allFeeds as $feed) {

            $hi = self::testar($feed, $feed['_id'], $ids);
            if ($hi != null || count($hi) != 0) {
                array_push($arr, $hi);

            }
        }
        if (count($arr) != 0) {
            $main=mainFeed::all();
            if (count($main) != 0) {
                mainFeed::query()->delete();
                foreach ($arr as $ar) {
                    $main = new mainFeed;
                    $main->_id = $ar['_id'];
                    $main->category = $ar['category'];
                    $main->summarised = $ar['summarised'];
                    $main->addedBy = $ar['addedBy'];
                    $main->feedOwner = $ar['feedOwner'];
                    $main->feedSchedule = $ar['feedSchedule'];
                    $main->feedType = $ar['feedType'];
                    $main->trending = $ar['trending'];
                    $main->location = $ar['location'];
                    $main->feedDate = $ar['feedDate'];
                    $main->feedTitle = $ar['feedTitle'];
                    $main->feedImage = $ar['feedImage'];
                    $main->likeCount = $ar['likeCount'];
                    $main->feedContent = $ar['feedContent'];
                    $main->feedSource = $ar['feedSource'];
                    $main->feedSourceTag = $ar['feedSourceTag'];
                    $main->feedGCM = $ar['feedGCM'];
                    $main->feedBirth = $ar['updated_at'];

                    $main->save();
                }
                return mainFeed::all();


            } else {
                foreach ($arr as $ar) {
                    $main = new mainFeed;
                    $main->_id = $ar['_id'];
                    $main->category = $ar['category'];
                    $main->summarised = $ar['summarised'];
                    $main->addedBy = $ar['addedBy'];
                    $main->feedOwner = $ar['feedOwner'];
                    $main->feedSchedule = $ar['feedSchedule'];
                    $main->feedType = $ar['feedType'];
                    $main->trending = $ar['trending'];
                    $main->location = $ar['location'];
                    $main->feedDate = $ar['feedDate'];
                    $main->feedTitle = $ar['feedTitle'];
                    $main->feedImage = $ar['feedImage'];
                    $main->likeCount = $ar['likeCount'];
                    $main->feedContent = $ar['feedContent'];
                    $main->feedSource = $ar['feedSource'];
                    $main->feedSourceTag = $ar['feedSourceTag'];
                    $main->feedGCM = $ar['feedGCM'];
                    $main->feedBirth = $ar['updated_at'];

                    $main->save();
                }
                return mainFeed::all();
            }
        }


    }


}
