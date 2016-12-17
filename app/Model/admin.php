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

    /*For whomever may it concern,
    "Long ago all classes lived together in harmony.Then everything changed when poor management attacked.Only the Avatar ,the master of all classes
    could stop them.But when the project needed him most, he vanished. A hundred commits passed.Me and my blackened soul  discovered a new Job. And although my progrmaming skills are great,
     he still has a lot to learn before he's ready to commit more. But I don't believe anyone can save this project."




    Best of luck,
    Rain04


    */
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
            $users = addUser::all();
            $feed = array();
            foreach ($feeds as $item) {
//                if(new DateTime() > new DateTime($item['feedDate'])){
//                    // $var is before today so use it
//                    return $item;
//                }

                array_push($feed, $item);
            }
            $feed = array_reverse($feed);

            return View::Make('addFeed')->with('users', $users)->with('feed', $feed)->with('tag1', $array)->with('user', $name)->with('tag', 'All')->with('tag2', 'All')->with('tag3', 'All');


        }
        /* if ($name == $user->name && $pwd == $user->password) {

        return Redirect::to('dashboard');


        }
        if ($name != $user->name && $pwd != $user->password) {

        return "bye";
        return Redirect::to('login')->with('message', 'Login Failed');;


        }*/
    }





    public static function dashboard($input)
    {


        $users = addUser::all();


        return View::Make('dashboard')->with('users', $users);
//
//        $feed = feeds::all();
//        $users = addUser::all();
//
//
//        return View::Make('dashboard')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('feed', $feed);


        /* $invitee = invite::all();
        $users = addUser::all();
        $savedtests = savedtests::getAnswers();
        $test = questions::all();
        $report = upload::where('status', '=', 'Pending')->get();
        $assistance = assistance::all();
        return View::Make('dashboard')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);

        */
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

        $users = addUser::all();
        $feed = array();
        foreach ($feeds as $item) {
            array_push($feed, $item);
        }
        $feed = array_reverse($feed);

        return View::Make('addFeed')->with('users', $users)->with('feed', $feed)->with('tag1', $array)->with('user', $user)->with('tag', 'All')->with('tag2', 'All')->with('tag3', 'All');

    }









    public static function viewFeed()
    {
        $staus = $_POST['statusTags'];

        $use = $_POST['user'];
        if ($_POST['button'] == "filter") {
            $array = array();
            $admin = admin::all();
            foreach ($admin as $ad) {
                array_push($array, $ad['name']);
            } //$admin as $ad
            $tag = $_POST['Category'];
            $owner = $_POST['owner'];
//I know the logic is stupid. I was lazy and I am suffering for it now
            $feeds = feeds::where('category', '=', $tag)->where('feedOwner', '=', $owner)->where('feedStatus', '=', $staus)->get();
            if ($tag == "All" && $owner == "All" && $staus == "All") {
                $feeds = feeds::all();
            } //$tag == "All" && $owner == "All"
            if ($tag != "All" && $owner == "All" && $staus == "All" ) {
                $feeds = feeds::where('category', '=', $tag)->get();
            } //$tag != "All" && $owner == "All"
            if ($tag == "All" && $owner != "All"  && $staus == "All" ) {
                $feeds = feeds::where('feedOwner', '=', $owner)->get();

            } //$tag == "All" && $owner != "All"
            if ($tag != "All" && $owner != "All" && $staus != "All") {
                $feeds = feeds::where('category', '=', $tag)->where('feedOwner', '=', $owner)->where('feedStatus', '=', $staus)->get();
            } //$tag != "All" && $owner != "All"

            if ($tag != "All" && $owner != "All" && $staus == "All") {
                $feeds = feeds::where('category', '=', $tag)->where('feedOwner', '=', $owner)->get();
            } //$tag != "All" && $owner != "All"

            if ($tag == "All" && $owner == "All" && $staus != "All") {
                $feeds = feeds::where('feedStatus', '=', $staus)->get();
            } //$tag != "All" && $owner != "All"

            if ($tag == "All" && $owner != "All" && $staus != "All") {
                $feeds = feeds::where('feedOwner', '=', $owner)->where('feedStatus', '=', $staus)->get();
            } //$tag != "All" && $owner != "All"

            if ($tag != "All" && $owner == "All" && $staus != "All") {
                $feeds = feeds::where('category', '=', $tag)->where('feedStatus', '=', $staus)->get();
            } //$tag != "All" && $owner != "All"


            $users = addUser::all();

            $feed = array();
            foreach ($feeds as $item) {
                array_push($feed, $item);
            }
            $feed = array_reverse($feed);
            return View::Make('addFeed')->with('users', $users)->with('feed', $feed)->with('tag', $tag)->with('tag1', $array)->with('tag2', $owner)->with('user', $use)->with('tag3',$staus);

        } else {
            $array = array();
            $admin = admin::all();
            foreach ($admin as $ad) {
                array_push($array, $ad['name']);
            } //$admin as $ad

            $tag = "All";
            $owner = "All";
            $feeds = feeds::orderBy('likeCount', 'desc')->get();
            $users = addUser::all();

            $feed = array();
            foreach ($feeds as $item) {
                array_push($feed, $item);
            }
            $feed = $feeds;

            return View::Make('addFeed')->with('users', $users)->with('feed', $feed)->with('tag', $tag)->with('tag1', $array)->with('tag2', $owner)->with('user', $use)->with('tag3','All');


        }

    }


    public static function setFeed()
    {
        $main = mainFeed::where('feedStatus', '=', 'Published')->orWhere('feedStatus', '=', 'Approved')->get();



        if (count($main) == 0 || !isset($main)) {

            $array = array();
            $excepted = array();
            $allFeeds = feeds::where('feedStatus', '=', 'Approved')->get();
            if (count($allFeeds) != 0 || isset($main)) {
                foreach ($allFeeds as $feed) {
					unset($feed['feedRemark']);
					unset($feed['feedSource']);
					unset($feed['feedContent']);
                    $date = self::dated($feed['updated_at']);
                    if ($date <= 1) {
                        array_push($array, $feed);
                    } else {
                        array_push($excepted, $feed);
                    }

                }
            }
            $array = array_reverse($array);
            $excepted = array_reverse($excepted);
            return View::make('setFeed')->with('main', $array)->with('other', $excepted);
        } else {

            $mainId = array();
            $array = mainFeed::where('feedStatus', '=', 'Published')->orWhere('feedStatus', '=', 'Approved')->get();
            $excepted = array();
            $feeds = feeds::where('feedStatus', '=', 'Approved')->get();
            foreach ($array as $main) {
                array_push($mainId, $main['_id']);
            }
            foreach ($feeds as $feed) {
					
                if (!in_array($feed['_id'], $mainId)) {
					unset($feed['feedRemark']);
					unset($feed['feedSource']);
					unset($feed['feedContent']);
					
                    array_push($excepted, $feed);
                }
            }
            return View::make('setFeed')->with('main', $array)->with('other', $excepted);
        }

    }

    public static function testFeed()
    {
        $main = mainFeed::all();

        if (count($main) == 0 || !isset($main)) {
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
        } else {

            $mainId = array();
            $array = mainFeed::all();
            $excepted = array();
            $feeds = feeds::all();
            foreach ($array as $main) {
                array_push($mainId, $main['_id']);
            }
            foreach ($feeds as $feed) {

                if (!in_array($feed['_id'], $mainId)) {
                    array_push($excepted, $feed);
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
        $mainCount= mainFeed::count();
        $arrayCount=count($arr);
        $diff=floor($arrayCount-$mainCount);


        if (count($arr) != 0) {
            $main = mainFeed::all();
            foreach ($main as $mainFeed) {
                $foundMainFeed = feeds::find($mainFeed['_id']);
                $foundMainFeed->feedStatus = "Approved";
                $foundMainFeed->save();
            }
            if (count($main) != 0) {
				
                mainFeed::query()->delete();
                foreach ($arr as $ar) {
                    $foundFeed = feeds::find($ar['_id']);
                    $foundFeed->feedStatus = "Published";
                    $foundFeed->save();
                    $main = new mainFeed;
                    $main->_id = $ar['_id'];
//                    $main->category = $ar['category'];
                    $main->summarised = $ar['summarised'];
//                    $main->addedBy = $ar['addedBy'];
//                    $main->feedOwner = $ar['feedOwner'];
//                    $main->feedSchedule = $ar['feedSchedule'];
//                    $main->feedType = $ar['feedType'];
//                    $main->trending = $ar['trending'];
//                    $main->location = $ar['location'];
//                    $main->feedDate = $ar['feedDate'];
                    $main->feedTitle = $ar['feedTitle'];
//                    $main->feedImage = $ar['feedImage'];
//                    $main->likeCount = $ar['likeCount'];
//                    $main->feedContent = $ar['feedContent'];
//                    $main->feedSource = $ar['feedSource'];
//                    $main->feedSourceTag = $ar['feedSourceTag'];
//                    $main->feedGCM = $ar['feedGCM'];
                    $main->feedBirth = $ar['updated_at'];
                    $main->feedStatus = $ar['feedStatus'];
//                    $main->feedRemark = $ar['feedRemark'];

                    $main->save();
                }
                if($diff>0)
                {
                    return addUser::countGcm($diff);
                }
                return mainFeed::all();


            } else {
                foreach ($arr as $ar) {
                    $foundFeed = feeds::find($ar['_id']);
                    $foundFeed->feedStatus = 
                    $foundFeed->save();
                    $main = new mainFeed;
                    $main->_id = $ar['_id'];
//                    $main->category = $ar['category'];
                    $main->summarised = $ar['summarised'];
//                    $main->addedBy = $ar['addedBy'];
//                    $main->feedOwner = $ar['feedOwner'];
//                    $main->feedSchedule = $ar['feedSchedule'];
//                    $main->feedType = $ar['feedType'];
//                    $main->trending = $ar['trending'];
//                    $main->location = $ar['location'];
//                    $main->feedDate = $ar['feedDate'];
                    $main->feedTitle = $ar['feedTitle'];
//                    $main->feedImage = $ar['feedImage'];
//                    $main->likeCount = $ar['likeCount'];
//                    $main->feedContent = $ar['feedContent'];
//                    $main->feedSource = $ar['feedSource'];
//                    $main->feedSourceTag = $ar['feedSourceTag'];
//                    $main->feedGCM = $ar['feedGCM'];
                    $main->feedBirth = $ar['updated_at'];
                    $main->feedStatus = "Published";
//                    $main->feedRemark = $ar['feedRemark'];
                    $main->save();
                }
                if($diff>0)
                {
                   return addUser::countGcm($diff);
                }
                return mainFeed::all();
            }
        }


    }


    public static function accept($input)
    {

        $rating = $_POST['star'];
        $tag=$_POST['tag'];
        $tag2=$_POST['tag2'];
        $tag3=$_POST['tag3'];
        $feed=$_POST['feed'];
        $content = $_POST['remarks'];
        $user=$_POST['user'];
        $content= htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE | ENT_DISALLOWED | ENT_HTML5, 'UTF-8');


        $feed = feeds::where('_id', '=', $_POST['id'])->first();
        if ($feed != null || !isset($feed)) {
            $feed->feedRating = $rating;
            if ($feed['feedRemark'] == "") {
                $feedRemark = $content . "  " ."\n". "[Added at " . date("Y-m-d h:i:sa",time()) . "  By ".$user." and gave " .$rating. "  stars"."]  " ."\n". '--------------------'."\n".$feed['feedRemark'];
                $feed->feedRemark = $feedRemark;
                $saved = $feed->save();
                if ($saved) {
                    if ($rating == "5") {
                        $feed->feedStatus = "Approved";
                    }
                    if ($rating == "0") {
                        $feed->feedStatus = "Rejected";
                    }
                    if ($rating == "3" || $rating == "4"  ) {
                        $feed->feedStatus = "Minor Pending Edits";
                    }

                    if ($rating == "1" || $rating == "2" ) {
                        $feed->feedStatus = "Major Pending Edits";
                    }

                    $feed->feedRating = $rating;
                    $feed->save();
                    return self::setFilter($tag,$tag2,$tag3);
                    return Redirect::to('addFeed');
                }
            }
            $feedRemark = $content . "  " ."\n". "[Added at " . date("Y-m-d h:i:sa",time()) . "  By ".$user." and gave " .$rating. "  stars"."]  " ."\n". '--------------------'."\n".$feed['feedRemark'];
            $feed->feedRemark = $feedRemark;

            $saved = $feed->save();
            if ($saved) {
                if ($rating == "5") {
                    $feed->feedStatus = "Approved";
                }
                if ($rating == "0") {
                    $feed->feedStatus = "Rejected";
                }
                if ($rating == "3" || $rating == "4"  ) {
                    $feed->feedStatus = "Minor Pending Edits";
                }

                if ($rating == "1" || $rating == "2" ) {
                    $feed->feedStatus = "Major Pending Edits";
                }
                $feed->feedRating = $rating;
                $feed->save();
                return self::setFilter($tag,$tag2,$tag3);
                return Redirect::to('addFeed');
            }


        }

    }


    private static function setFilter($tag,$tag2,$tag3)
    {
        $staus = $tag3;

        $use = $_POST['user'];

            $array = array();
            $admin = admin::all();
            foreach ($admin as $ad) {
                array_push($array, $ad['name']);
            } //$admin as $ad
            $tag = $tag;
            $owner = $tag2;
//I know the logic is stupid. I was lazy and I am suffering for it now
            $feeds = feeds::where('category', '=', $tag)->where('feedOwner', '=', $owner)->where('feedStatus', '=', $staus)->get();
            if ($tag == "All" && $owner == "All" && $staus == "All") {
                $feeds = feeds::all();
            } //$tag == "All" && $owner == "All"
            if ($tag != "All" && $owner == "All" && $staus == "All" ) {
                $feeds = feeds::where('category', '=', $tag)->get();
            } //$tag != "All" && $owner == "All"
            if ($tag == "All" && $owner != "All"  && $staus == "All" ) {
                $feeds = feeds::where('feedOwner', '=', $owner)->get();

            } //$tag == "All" && $owner != "All"
            if ($tag != "All" && $owner != "All" && $staus != "All") {
                $feeds = feeds::where('category', '=', $tag)->where('feedOwner', '=', $owner)->where('feedStatus', '=', $staus)->get();
            } //$tag != "All" && $owner != "All"

            if ($tag != "All" && $owner != "All" && $staus == "All") {
                $feeds = feeds::where('category', '=', $tag)->where('feedOwner', '=', $owner)->get();
            } //$tag != "All" && $owner != "All"

            if ($tag == "All" && $owner == "All" && $staus != "All") {
                $feeds = feeds::where('feedStatus', '=', $staus)->get();
            } //$tag != "All" && $owner != "All"

            if ($tag == "All" && $owner != "All" && $staus != "All") {
                $feeds = feeds::where('feedOwner', '=', $owner)->where('feedStatus', '=', $staus)->get();
            } //$tag != "All" && $owner != "All"

            if ($tag != "All" && $owner == "All" && $staus != "All") {
                $feeds = feeds::where('category', '=', $tag)->where('feedStatus', '=', $staus)->get();
            } //$tag != "All" && $owner != "All"


            $users = addUser::all();


            $feed = array();
            foreach ($feeds as $item) {
                array_push($feed, $item);
            }
            $feed = array_reverse($feed);
            return View::Make('addFeed')->with('users', $users)->with('feed', $feed)->with('tag', $tag)->with('tag1', $array)->with('tag2', $owner)->with('user', $use)->with('tag3',$staus);



    }


    public static function comments()
    {
        $comments= comments::all();
        return View::make('comments')->with('comments',$comments);
    }


}

