<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Date;
use Jenssegers\Mongodb\Schema\Blueprint;
use View;
use Redirect;
use Input;


class feeds extends Eloquent
{
    //

    protected $connection = "mongodb";
    protected $collection = "newsFeed";


    public static function addFeed($input)
    {
        $model = new self();
        $model->feedTitle = $input['feedTitle'];
        $model->feedImage = $input['feedImage'];
        $model->feedImage_lw = $input['feedImage_lw'];
        $model->feedContent = $input['feedContent'];
        $model->feedSource = $input['sourceUrl'];
        $model->feedSourceTag = $input['sourceTitle'];
        $isSaved = $model->save();
        if ($isSaved) {
            return array("code" => "0", "status" => "Successfully added");
        } else {
            return array("code" => "1", "status" => "error");

        }

    }


    public static function getFeed($input)
    {
        $model = new self();
        $id = $input['sessionHandle'];
        $cat=$input['category'];
        $user = addUser::where('usrSessionHdl', '=', $id)->get();
        if (!isset($user) || count($user) == 0) {
            return array("resultCode" => "1", "status" => "error", "message" => "User can't be found");


        } else {
            if(count($cat)==0) {
                $feed = $model::all();
                $categories = 'All,Product Management,Agile,Product Marketing,UX,Growth Hacking,Roadmapping,Sales Enablement,Career,Leadership,Executive Presence';
				$url='https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LA97C/agile.png?pub_secret=168e02e6ed,https://files.slack.com/files-pri/T04T20JQR-F1X3B0T1V/product_marketing.png?pub_secret=c86510df6d,https://files.slack.com/files-pri/T04T20JQR-F1X32A06S/ux_icon.png?pub_secret=4d8a67cca5,https://files.slack.com/files-pri/T04T20JQR-F1X3FB3S5/growth_hack.png?pub_secret=7bd2efd880,https://files.slack.com/files-pri/T04T20JQR-F1X3294J2/road_map.png?pub_secret=8c0e9ba2dc,https://files.slack.com/files-pri/T04T20JQR-F1X3B1M2T/sales.png?pub_secret=5af5c105d1,https://files.slack.com/files-pri/T04T20JQR-F1X3243K8/career.png?pub_secret=6349569c46,https://files.slack.com/files-pri/T04T20JQR-F1X3AUW7R/leadership_icon.png?pub_secret=920e647a14,https://files.slack.com/files-pri/T04T20JQR-F1X3LD5AN/executive_presence.png?pub_secret=4316358c71';

                return array("status" => "success", "resultCode" => "1", "categories" => $categories, 'image'=> $url, "userFeed" => $feed,);
            }
            else{
                $array=array();
                foreach($cat as $item)
                {

                    $feed=feeds::where('category','=',$item)->get();
                    foreach($feed as $items){
                        array_push($array,$items);

                    }

                }
                $categories = 'All,Product Management,Agile,Product Marketing,UX,Growth Hacking,Roadmapping,Sales Enablement,Career,Leadership,Executive Presence';
				$url='https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LA97C/agile.png?pub_secret=168e02e6ed,https://files.slack.com/files-pri/T04T20JQR-F1X3B0T1V/product_marketing.png?pub_secret=c86510df6d,https://files.slack.com/files-pri/T04T20JQR-F1X32A06S/ux_icon.png?pub_secret=4d8a67cca5,https://files.slack.com/files-pri/T04T20JQR-F1X3FB3S5/growth_hack.png?pub_secret=7bd2efd880,https://files.slack.com/files-pri/T04T20JQR-F1X3294J2/road_map.png?pub_secret=8c0e9ba2dc,https://files.slack.com/files-pri/T04T20JQR-F1X3B1M2T/sales.png?pub_secret=5af5c105d1,https://files.slack.com/files-pri/T04T20JQR-F1X3243K8/career.png?pub_secret=6349569c46,https://files.slack.com/files-pri/T04T20JQR-F1X3AUW7R/leadership_icon.png?pub_secret=920e647a14,https://files.slack.com/files-pri/T04T20JQR-F1X3LD5AN/executive_presence.png?pub_secret=4316358c71';

                return array("status" => "success", "resultCode" => "1", "Categories" => $categories, 'image'=> $url,"userFeed" => $array,);            }

        }
    }


    public static function saveFeed($input)
    {
        $model = new self();
        $model->category= $_POST['Category'];
        $model->trending=$_POST['trending'];
        $title = $model->feedTitle = $input['feedTitle'];
        $model->feedImage = $input['feedImage'];
        $model->feedImage_lw = $input['feedImage_lw'];
        $model->feedContent = $input['feedContent'];
        $model->feedSource = $input['sourceUrl'];
        $model->feedSourceTag = $input['sourceTitle'];
		if(isset($_POST['gcm'])){
					$model->feedGCM = "Yes";
					
				}
				else{
					$model->feedGCM = "No";
				}
		
        $files = Input::file('images');
        if (!Input::hasFile('images')) {
            $model->feedAudio = "";
            $isSaved = $model->save();
            if ($isSaved) {
                $feed = feeds::all();
                $invitee = invite::all();
                $users = addUser::all();
                $savedtests = savedtests::getAnswers();
                $test = questions::all();
                $report = upload::all();
                $assistance = assistance::all();
				if(isset($_POST['gcm'])){
                $gcm = addUser::feedGcm($title);
				}
		

                return Redirect::to('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);

            } else {
                return array("code" => "1", "status" => "error");

            }

        }
        if (Input::hasFile('images')) {
            foreach ($files as $file) {
                $destinationPath = public_path() . '/audio/';
                $filename_original = $file->getClientOriginalName();
                $filename = preg_replace('/\s+/', '', $filename_original);
                $file->move($destinationPath, $filename);
                $allowed = array('mp3', 'wav');
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!in_array($ext, $allowed)) {
                    return 'Incorrect file extension';
                }
                if (in_array($ext, $allowed)) {
                    $pathToFile = $destinationPath . $filename;
                    $string = "/var/www/html/Assessment/public";
                    $path = 'http://' . $_SERVER['HTTP_HOST'] . str_replace($string, '', $pathToFile);
                    $model->feedAudio = $path;

                    $isSaved = $model->save();
                    if ($isSaved) {
                        $feed = feeds::all();
                        $invitee = invite::all();
                        $users = addUser::all();
                        $savedtests = savedtests::getAnswers();
                        $test = questions::all();
                        $report = upload::all();
                        $assistance = assistance::all();


                        return Redirect::to('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);

                    } else {
                        return array("code" => "1", "status" => "error");

                    }

                }
            }
        }

    }


    public static function deleteFeed($input)
    {

        $model = new self();
        $id = $_GET['action'];
        $isSaved = $model::find($id)->delete();
        if ($isSaved) {

            $feed = feeds::all();
            $invitee = invite::all();
            $users = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test = questions::all();
            $report = upload::all();
            $assistance = assistance::all();


            return Redirect::to('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);


        } else {
            return array("code" => "1", "status" => "error");


        }


    }


    public static function saveEditFeed($input)

    {

        $id = $input['id'];
        $model = self::find($id);
		$title = $model->feedTitle = $input['feedTitle'];
        $model->feedImage = $input['feedImage'];
        $model->category= $_POST['Category'];
        $model->trending=$_POST['trending'];
        $model->feedImage_lw = $input['feedImage_lw'];
        $model->feedContent = $input['feedContent'];
        $model->feedSource = $input['sourceUrl'];
        $model->feedSourceTag = $input['sourceTitle'];
		if(isset($_POST['gcm'])){
					$model->feedGCM = "Yes";
					
				}
				else{
					$model->feedGCM = "No";
				}
        $files = Input::file('images');
        if (!Input::hasFile('images')) {
            $isSaved = $model->save();
            if ($isSaved) {
                $feed = feeds::all();
                $invitee = invite::all();
                $users = addUser::all();
                $savedtests = savedtests::getAnswers();
                $test = questions::all();
                $report = upload::all();
                $assistance = assistance::all();
				if(isset($_POST['gcm'])){
                $gcm = addUser::feedGcm($title);
				}
		


                return Redirect::to('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);

            } else {
                return array("code" => "1", "status" => "error");

            }

        }
        if (Input::hasFile('images')) {
            $files = Input::file('images');
            foreach ($files as $file) {
                $destinationPath = public_path() . '/audio/';
                $filename_original = $file->getClientOriginalName();
                $filename = preg_replace('/\s+/', '', $filename_original);
                $file->move($destinationPath, $filename);
                $allowed = array('mp3', 'wav');
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!in_array($ext, $allowed)) {
                    return 'Incorrect file extension';
                }
                if (in_array($ext, $allowed)) {
                    $path = $destinationPath . $filename;
                    $model->feedAudio = $path;


                    $isSaved = $model->save();
                    if ($isSaved) {
                        $feed = feeds::all();
                        $invitee = invite::all();
                        $users = addUser::all();
                        $savedtests = savedtests::getAnswers();
                        $test = questions::all();
                        $report = upload::all();
                        $assistance = assistance::all();


                        return View::Make('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);

                    } else {
                        return array("code" => "1", "status" => "error");

                    }

                }
            }
        }
    }




}
