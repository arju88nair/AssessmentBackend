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
        $user = addUser::where('usrSessionHdl', '=', $id)->get();
        if (!isset($user) || count($user) == 0) {
            return array("resultCode" => "1", "status" => "error", "message" => "User can't be found");


        } else {
            $feed = $model::all();

            return array("status" => "success", "resultCode" => "1", "userFeed" => $feed,);

        }
    }


    public static function saveFeed($input)
    {
        $model = new self();
        $title = $model->feedTitle = $input['feedTitle'];
        $model->feedImage = $input['feedImage'];
        $model->feedImage_lw = $input['feedImage_lw'];
        $model->feedContent = $input['feedContent'];
        $model->feedSource = $input['sourceUrl'];
        $model->feedSourceTag = $input['sourceTitle'];
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

                $gcm = addUser::feedGcm($title);

                return View::Make('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);

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


                        return View::Make('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);

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
        $model->feedTitle = $input['feedTitle'];
        $model->feedImage = $input['feedImage'];
        $model->feedImage_lw = $input['feedImage_lw'];
        $model->feedContent = $input['feedContent'];
        $model->feedSource = $input['sourceUrl'];
        $model->feedSourceTag = $input['sourceTitle'];
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


                return View::Make('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);

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
