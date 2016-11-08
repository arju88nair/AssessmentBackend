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

    /*For whoever may it concern,
"Long ago all classes lived together in harmony.Then everything changed when poor management attacked.Only the Avatar ,the master of all classes
could stop them.But when the project needed him most, he vanished. A hundred commits passed.Me and my blackened soul  discovered a new Job. And although my progrmaming skills are great,
 he still has a lot to learn before he's ready to commit more. But I don't believe anyone can save this project."



    "I pity the fool who have to take up on this project,I pity the fool." (Read in Mr.T's voice)
Best of luck,
Rain04


*/
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
            return array(
                "code" => "0",
                "status" => "Successfully added"
            );
        } else {
            return array(
                "code" => "1",
                "status" => "error"
            );

        }

    }


    public static function getFeed($input)
    {
        $model = new self();
        $id = $input['sessionHandle'];
        $cat = $input['category'];
        $uid = $input['uId'];
        $idArray = $input['ids'];
        $feedArray = array();

        foreach ($idArray as $idA) {
            $feed = $model::where('_id', '=', $idA)->first();
            if ($feed == null) {
                return array(
                    "status" => "error",
                    "resultCode" => "0",
                    "message" => "One or many of the feed(s) can't be found"
                );
            }
        }
        $user = addUser::where('usrSessionHdl', '=', $id)->first();
        if ($id == "Guest") {

            $guest = addUser::where('uniqueDeviceID', '=', $input['uId'])->where('usrSessionHdl', '=', 'Guest')->first();
            if ($guest['feedCount'] >= 10) {


                if (count($cat) == 0) {
                    $feedArray = array();

                    foreach ($idArray as $id) {
                        $feed = $model::where('_id', '=', $id)->where('feedStatus', '=', 'Approved')->first();
                        array_push($feedArray, $feed);
                    }

                    $feed = $feedArray;
                    $array = array();
                    foreach ($feed as $item) {
                        $feedid = $item['_id'];
                        $item->liked = "No";
                        array_push($array, $item);
                    }
                    $category = extra::first();


                    $categories = 'All,Product Management,Agile,Product Marketing,UX,Growth Hacking,Roadmapping,Sales Enablement,Career,Leadership,Executive Presence';
                    $url = 'https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LA97C/agile.png?pub_secret=168e02e6ed,https://files.slack.com/files-pri/T04T20JQR-F1X3B0T1V/product_marketing.png?pub_secret=c86510df6d,https://files.slack.com/files-pri/T04T20JQR-F1X32A06S/ux_icon.png?pub_secret=4d8a67cca5,https://files.slack.com/files-pri/T04T20JQR-F1X3FB3S5/growth_hack.png?pub_secret=7bd2efd880,https://files.slack.com/files-pri/T04T20JQR-F1X3294J2/road_map.png?pub_secret=8c0e9ba2dc,https://files.slack.com/files-pri/T04T20JQR-F1X3B1M2T/sales.png?pub_secret=5af5c105d1,https://files.slack.com/files-pri/T04T20JQR-F1X3243K8/career.png?pub_secret=6349569c46,https://files.slack.com/files-pri/T04T20JQR-F1X3AUW7R/leadership_icon.png?pub_secret=920e647a14,https://files.slack.com/files-pri/T04T20JQR-F1X3LD5AN/executive_presence.png?pub_secret=4316358c71';

                    return array(
                        "status" => "success",
                        "resultCode" => "1",
                        "categories" => $categories,
                        'image' => $url,
                        "userFeed" => $array,
                        'category' => $category['categories'],
                        'feedCount' => $guest['feedCount'],
                        "message" => "User Exhausted Feed Limit"
                    );
                } else {
                    $array = array();
                    foreach ($cat as $item) {
                        $feedArray = array();

                        foreach ($idArray as $id) {
                            $feed = $model::where('_id', '=', $id)->where('feedStatus', '=', 'Approved')->first();
                            array_push($feedArray, $feed);
                        }

                        $feed = $feedArray;

                        foreach ($feed as $item) {
                            $userArray = $user['liked'];

                            $feedid = $item['_id'];
                            if (in_array($feedid, $userArray)) {
                                $item->liked = "Yes";
                            } else {
                                $item->liked = "No";

                            }
                            array_push($array, $item);
                        }

                    }
                    $category = extra::first();

                    $categories = 'All,Product Management,Agile,Product Marketing,UX,Growth Hacking,Roadmapping,Sales Enablement,Career,Leadership,Executive Presence';
                    $url = 'https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LA97C/agile.png?pub_secret=168e02e6ed,https://files.slack.com/files-pri/T04T20JQR-F1X3B0T1V/product_marketing.png?pub_secret=c86510df6d,https://files.slack.com/files-pri/T04T20JQR-F1X32A06S/ux_icon.png?pub_secret=4d8a67cca5,https://files.slack.com/files-pri/T04T20JQR-F1X3FB3S5/growth_hack.png?pub_secret=7bd2efd880,https://files.slack.com/files-pri/T04T20JQR-F1X3294J2/road_map.png?pub_secret=8c0e9ba2dc,https://files.slack.com/files-pri/T04T20JQR-F1X3B1M2T/sales.png?pub_secret=5af5c105d1,https://files.slack.com/files-pri/T04T20JQR-F1X3243K8/career.png?pub_secret=6349569c46,https://files.slack.com/files-pri/T04T20JQR-F1X3AUW7R/leadership_icon.png?pub_secret=920e647a14,https://files.slack.com/files-pri/T04T20JQR-F1X3LD5AN/executive_presence.png?pub_secret=4316358c71';

                    return array(
                        "status" => "success",
                        "resultCode" => "1",
                        "categories" => $categories,
                        'image' => $url,
                        "userFeed" => $array,
                        'category' => $category['categories'],
                        'feedCount' => $guest['feedCount'],
                        "message" => "User Exhausted Feed Limit"
                    );
                }
                return array(
                    "status" => "warning",
                    "resultCode" => "0",
                    "message" => "User Exhausted Feed Limit"
                );
            } else {
                if (!isset($guest) || count($guest) == 0) {
                    return array(
                        "status" => "error",
                        "resultCode" => "0",
                        "message" => "User Can't Be Found"
                    );

                } else {

                    if (count($cat) == 0) {
                        $feedArray = array();

                        foreach ($idArray as $id) {
                            $feed = $model::where('_id', '=', $id)->where('feedStatus', '=', 'Approved')->first();
                            array_push($feedArray, $feed);
                        }

                        $feed = $feedArray;
                        $array = array();
                        foreach ($feed as $item) {
                            $userArray = $guest['liked'];

                            $feedid = $item['_id'];
                            if (in_array($feedid, $userArray)) {
                                $item->liked = "Yes";
                            } else {
                                $item->liked = "No";

                            }
                            array_push($array, $item);
                        }
                        $category = extra::first();


                        $categories = 'All,Product Management,Agile,Product Marketing,UX,Growth Hacking,Roadmapping,Sales Enablement,Career,Leadership,Executive Presence';
                        $url = 'https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LA97C/agile.png?pub_secret=168e02e6ed,https://files.slack.com/files-pri/T04T20JQR-F1X3B0T1V/product_marketing.png?pub_secret=c86510df6d,https://files.slack.com/files-pri/T04T20JQR-F1X32A06S/ux_icon.png?pub_secret=4d8a67cca5,https://files.slack.com/files-pri/T04T20JQR-F1X3FB3S5/growth_hack.png?pub_secret=7bd2efd880,https://files.slack.com/files-pri/T04T20JQR-F1X3294J2/road_map.png?pub_secret=8c0e9ba2dc,https://files.slack.com/files-pri/T04T20JQR-F1X3B1M2T/sales.png?pub_secret=5af5c105d1,https://files.slack.com/files-pri/T04T20JQR-F1X3243K8/career.png?pub_secret=6349569c46,https://files.slack.com/files-pri/T04T20JQR-F1X3AUW7R/leadership_icon.png?pub_secret=920e647a14,https://files.slack.com/files-pri/T04T20JQR-F1X3LD5AN/executive_presence.png?pub_secret=4316358c71';

                        return array(
                            "status" => "success",
                            "resultCode" => "1",
                            "categories" => $categories,
                            'image' => $url,
                            "userFeed" => $array,
                            'category' => $category['categories'],
                            'feedCount' => $guest['feedCount']
                        );
                    } else {
                        $array = array();
                        foreach ($cat as $item) {
                            $feedArray = array();

                            foreach ($idArray as $id) {
                                $feed = $model::where('_id', '=', $id)->where('feedStatus', '=', 'Approved')->first();
                                array_push($feedArray, $feed);
                            }

                            $feed = $feedArray;
                            $feed = feeds::where('category', '=', $item)->get();
                            foreach ($feed as $items) {

                                $feedid = $items['_id'];
                                $item->liked = "No";
                                $feedid = $items['_id'];
                                array_push($array, $items);

                            }

                        }
                        $category = extra::first();

                        $categories = 'All,Product Management,Agile,Product Marketing,UX,Growth Hacking,Roadmapping,Sales Enablement,Career,Leadership,Executive Presence';
                        $url = 'https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LA97C/agile.png?pub_secret=168e02e6ed,https://files.slack.com/files-pri/T04T20JQR-F1X3B0T1V/product_marketing.png?pub_secret=c86510df6d,https://files.slack.com/files-pri/T04T20JQR-F1X32A06S/ux_icon.png?pub_secret=4d8a67cca5,https://files.slack.com/files-pri/T04T20JQR-F1X3FB3S5/growth_hack.png?pub_secret=7bd2efd880,https://files.slack.com/files-pri/T04T20JQR-F1X3294J2/road_map.png?pub_secret=8c0e9ba2dc,https://files.slack.com/files-pri/T04T20JQR-F1X3B1M2T/sales.png?pub_secret=5af5c105d1,https://files.slack.com/files-pri/T04T20JQR-F1X3243K8/career.png?pub_secret=6349569c46,https://files.slack.com/files-pri/T04T20JQR-F1X3AUW7R/leadership_icon.png?pub_secret=920e647a14,https://files.slack.com/files-pri/T04T20JQR-F1X3LD5AN/executive_presence.png?pub_secret=4316358c71';

                        return array(
                            "status" => "success",
                            "resultCode" => "1",
                            "categories" => $categories,
                            'image' => $url,
                            "userFeed" => $array,
                            'category' => $category['categories'],
                            'feedCount' => $guest['feedCount']
                        );
                    }
                }
            }
        } else {


            if (!isset($user) || count($user) == 0) {
                return array(
                    "resultCode" => "1",
                    "status" => "error",
                    "message" => "User can't be found"
                );


            } else {
                if (count($cat) == 0) {
                    $feedArray = array();

                    foreach ($idArray as $id) {
                        $feed = $model::where('_id', '=', $id)->where('feedStatus', '=', 'Approved')->first();
                        array_push($feedArray, $feed);
                    }

                    $feed = $feedArray;
                    $array = array();
                    foreach ($feed as $item) {
                        $userArray = $user['liked'];

                        $feedid = $item['_id'];
                        if (in_array($feedid, $userArray)) {
                            $item->liked = "Yes";
                        } else {
                            $item->liked = "No";

                        }
                        array_push($array, $item);
                    }
                    $category = extra::first();


                    $categories = 'All,Product Management,Agile,Product Marketing,UX,Growth Hacking,Roadmapping,Sales Enablement,Career,Leadership,Executive Presence';
                    $url = 'https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LA97C/agile.png?pub_secret=168e02e6ed,https://files.slack.com/files-pri/T04T20JQR-F1X3B0T1V/product_marketing.png?pub_secret=c86510df6d,https://files.slack.com/files-pri/T04T20JQR-F1X32A06S/ux_icon.png?pub_secret=4d8a67cca5,https://files.slack.com/files-pri/T04T20JQR-F1X3FB3S5/growth_hack.png?pub_secret=7bd2efd880,https://files.slack.com/files-pri/T04T20JQR-F1X3294J2/road_map.png?pub_secret=8c0e9ba2dc,https://files.slack.com/files-pri/T04T20JQR-F1X3B1M2T/sales.png?pub_secret=5af5c105d1,https://files.slack.com/files-pri/T04T20JQR-F1X3243K8/career.png?pub_secret=6349569c46,https://files.slack.com/files-pri/T04T20JQR-F1X3AUW7R/leadership_icon.png?pub_secret=920e647a14,https://files.slack.com/files-pri/T04T20JQR-F1X3LD5AN/executive_presence.png?pub_secret=4316358c71';

                    return array(
                        "status" => "success",
                        "resultCode" => "1",
                        "categories" => $categories,
                        'image' => $url,
                        "userFeed" => $array,
                        'category' => $category['categories'],
                        'feedCount' => 0
                    );
                } else {
                    $array = array();
                    foreach ($cat as $item) {
                        $feedArray = array();

                        foreach ($idArray as $id) {
                            $feed = $model::where('_id', '=', $id)->where('feedStatus', '=', 'Approved')->first();
                            array_push($feedArray, $feed);
                        }

                        $feed = $feedArray;
                        $feed = feeds::where('category', '=', $item)->where('feedStatus', '=', 'Approved')->get();
                        foreach ($feed as $items) {
                            $userArray = $user['liked'];
                            $feedid = $items['_id'];
                            if (in_array($feedid, $userArray)) {
                                $items->liked = "Yes";
                            } else {
                                $items->liked = "No";
                            }
                            $feedid = $items['_id'];
                            array_push($array, $items);

                        }

                    }
                    $category = extra::first();

                    $categories = 'All,Product Management,Agile,Product Marketing,UX,Growth Hacking,Roadmapping,Sales Enablement,Career,Leadership,Executive Presence';
                    $url = 'https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LFLKC/product_management.png?pub_secret=b4594be939,https://files.slack.com/files-pri/T04T20JQR-F1X3LA97C/agile.png?pub_secret=168e02e6ed,https://files.slack.com/files-pri/T04T20JQR-F1X3B0T1V/product_marketing.png?pub_secret=c86510df6d,https://files.slack.com/files-pri/T04T20JQR-F1X32A06S/ux_icon.png?pub_secret=4d8a67cca5,https://files.slack.com/files-pri/T04T20JQR-F1X3FB3S5/growth_hack.png?pub_secret=7bd2efd880,https://files.slack.com/files-pri/T04T20JQR-F1X3294J2/road_map.png?pub_secret=8c0e9ba2dc,https://files.slack.com/files-pri/T04T20JQR-F1X3B1M2T/sales.png?pub_secret=5af5c105d1,https://files.slack.com/files-pri/T04T20JQR-F1X3243K8/career.png?pub_secret=6349569c46,https://files.slack.com/files-pri/T04T20JQR-F1X3AUW7R/leadership_icon.png?pub_secret=920e647a14,https://files.slack.com/files-pri/T04T20JQR-F1X3LD5AN/executive_presence.png?pub_secret=4316358c71';

                    return array(
                        "status" => "success",
                        "resultCode" => "1",
                        "categories" => $categories,
                        'image' => $url,
                        "userFeed" => $array,
                        'category' => $category['categories'],
                        'feedCount' => 0
                    );
                }

            }
        }
    }


    public static function saveFeed($input)
    {
        $model = new self();
        $model->category = $_POST['Category'];
        $model->summarised = $input['summarised'];
        $model->addedBy = $input['addedBy'];
        $model->feedOwner = $_POST['feedOwner'];
        $model->feedStatus = "Waiting for Approval";
        $model->feedRemark = "";
        $model->feedRating = 0;
        $model->feedSchedule = $input['feedSchedule'];
        $model->feedType = $_POST['type'];
        if ($_POST['feedOwner'] == "" || $_POST['feedOwner'] == null) {
            $model->feedOwner = "content_admin";
        }
        $model->trending = $_POST['trending'];
        $model->location = $_POST['loc'];
        $model->feedDate = $_POST['feedDate'];
        $title = $model->feedTitle = $input['feedTitle'];
//        $model->feedImage = $input['feedImage'];
        $model->likeCount = 0;


        //Image upoading
        $images = Input::file('image');

        foreach ($images as $file) {
            $destinationPath = public_path() . '/image/';
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $fileName = rand() . '.' . $extension; // renaming image[
            $file->move($destinationPath, $fileName); // uploading file to given path
            $pathToFile = $destinationPath . $fileName;
            $string = "/var/www/html/Assessment/public";
            $path = 'http://' . $_SERVER['HTTP_HOST'] . str_replace($string, '', $pathToFile);
            $model->feedImage = $path;
        }
        //Image end

        $model->feedContent = $input['feedContent'];
        $model->feedSource = $input['sourceUrl'];
        $model->feedSourceTag = $input['sourceTitle'];


        if (isset($_POST['gcm'])) {
            $model->feedGCM = "Yes";

        } else {
            $model->feedGCM = "No";
        }

        $files = Input::file('images');
        if (!Input::hasFile('images')) {
            if ($input['feedaudio'] == "" || $input['feedaudio'] == NULL) {
                $model->feedAudio = "";
            } else {
                $model->feedAudio = $input['feedaudio'];
            }

            $isSaved = $model->save();
            if ($isSaved) {
                $feed = feeds::all();
                $invitee = invite::all();
                $users = addUser::all();
                $savedtests = savedtests::getAnswers();
                $test = questions::all();
                $report = upload::all();
                $assistance = assistance::all();
                if (isset($_POST['gcm'])) {
                    $gcm = addUser::feedGcm($title, $model['_id']);

                }


                return Redirect::to('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);

            } else {
                return array(
                    "code" => "1",
                    "status" => "error"
                );

            }

        }


        $model->feedAudio = $input['feedaudio'];
        if (Input::hasFile('images')) {
            foreach ($files as $file) {
                $destinationPath = public_path() . '/audio/';
                $filename_original = $file->getClientOriginalName();
                $filename = preg_replace('/\s+/', '', $filename_original);
                $file->move($destinationPath, $filename);
                $allowed = array(
                    'mp3',
                    'wav'
                );
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
                        $feeds = feeds::all();
                        $invitee = invite::all();
                        $users = addUser::all();
                        $savedtests = savedtests::getAnswers();
                        $test = questions::all();
                        $report = upload::all();
                        $assistance = assistance::all();
                        $feed = array();
                        foreach ($feeds as $item) {
                            array_push($feed, $item);
                        }
                        $feed = array_reverse($feed);

                        return Redirect::to('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);

                    } else {
                        return array(
                            "code" => "1",
                            "status" => "error"
                        );

                    }

                }
            }
        }

    }


    public static function deleteFeed($input)
    {

        $model = new self();
        $id = $_GET['action'];
        $isSaved = $model::find($id);
        $mainFeed = mainFeed::find($id);
        if ($mainFeed != [] || !empty($mainFeed)) {
            $mainFeed->delete();
        }
        $image = "/var/www/html/Assessment/public/image/" . substr($isSaved['feedImage'], 63);
        $audio = "/var/www/html/Assessment/public/audio/" . substr($isSaved['feedAudio'], 63);
        $check = "http://ec2-52-33-112-148.us-west-2.compute.amazonaws.com/";

        if (strpos($check, $isSaved['feedImage']) !== false) {
            if ($isSaved['feedImage'] != "" || $isSaved['feedImage'] != null) {
                unlink($image);
            }

        }

        if (strpos($check, $isSaved['feedImage']) !== false) {
            if ($isSaved['feedImage'] != "" || $isSaved['feedImage'] != null) {
                unlink($image);
            }

        }


        $isSaved = $model::find($id)->delete();
        if ($isSaved) {


            $array = array();
            $admin = admin::all();

            /* $liked=like::where('feedId','=',$feedid)->get(); */
            /* 			return count($liked);
             */
            foreach ($admin as $ad) {
                array_push($array, $ad['name']);
            }
            $feed = feeds::all();
            $array1 = array();
            foreach ($feed as $item) {
                $feedid = $item['_id'];
                $liked = like::where('feedId', '=', $feedid)->get();
                $item->likeCount = count($liked);
                array_push($array1, $item);
            }
            $feeds = $array1;
            $invitee = invite::all();
            $users = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test = questions::all();
            $report = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();
            $feed = array();
            foreach ($feeds as $item) {
                array_push($feed, $item);
            }
            $feed = array_reverse($feed);
            return Redirect::to('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed)->with('tag1', $array);

        } else {
            return array(
                "code" => "1",
                "status" => "error"
            );


        }


    }


    public static function saveEditFeed($input)
    {

        $id = $input['id'];
        $model = self::find($id);
        $new = mainFeed::find($id);

        if ($new != "") {


            $title = $new->feedTitle = $input['feedTitle'];
            $new->summarised = $input['summarised'];
            $new->addedBy = $input['addedBy'];
            $new->feedOwner = $_POST['feedOwner'];
            $new->feedDate = $_POST['feedDate'];
            $new->feedSchedule = $input['feedSchedule'];
            $new->feedType = $_POST['type'];
            $new->category = $_POST['Category'];
            $new->location = $_POST['loc'];
            $new->trending = $_POST['trending'];
            $new->feedContent = $input['feedContent'];
            $new->feedSource = $input['sourceUrl'];
            $new->feedStatus = "Pending";
            $new->feedRemark = "";
            $new->feedSourceTag = $input['sourceTitle'];
        }

        $title = $model->feedTitle = $input['feedTitle'];
        $model->summarised = $input['summarised'];
        $model->feedStatus = "Waiting for Approval";
        $model->feedRemark = "";
        $model->addedBy = $input['addedBy'];
        $model->feedRating = 0;
        $model->feedOwner = $_POST['feedOwner'];
        $model->feedDate = $_POST['feedDate'];
        $model->feedSchedule = $input['feedSchedule'];
        if ($_POST['feedOwner'] == "" || $_POST['feedOwner'] == null) {
            $model->feedOwner = "content_admin";
        }
        $model->feedType = $_POST['type'];
        $model->category = $_POST['Category'];
        $model->location = $_POST['loc'];
        $model->trending = $_POST['trending'];
        $model->feedContent = $input['feedContent'];
        $model->feedSource = $input['sourceUrl'];
        $model->feedSourceTag = $input['sourceTitle'];
        if ($input['feedImage'] != "" || $input['feedImage'] != null) {
            $model->feedImage = $input['feedImage'];
            if ($new != "") {
                $new->feedImage = $input['feedImage'];
            }
        } else {
            //Image upoading
            $images = Input::file('image');

            foreach ($images as $file) {
                $destinationPath = public_path() . '/image/';
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $fileName = rand() . '.' . $extension; // renaming image
                $file->move($destinationPath, $fileName); // uploading file to given path
                $pathToFile = $destinationPath . $fileName;
                $string = "/var/www/html/Assessment/public";
                $path = 'http://' . $_SERVER['HTTP_HOST'] . str_replace($string, '', $pathToFile);
                $model->feedImage = $path;
                if ($new != "") {
                    $new->feedImage = $input['feedImage'];
                }
            }
            //Image end
        }
        if (isset($_POST['gcm'])) {
            $model->feedGCM = "Yes";
            if ($new != "") {
                $new->feedGCM = "Yes";
            }

        } else {
            $model->feedGCM = "No";
        }
        if ($new != "") {
            $new->feedGCM = "No";
        }
        $files = Input::file('images');

        if (!Input::hasFile('images')) {
            $model->feedAudio = $input['feedaudio'];
            $isSaved = $model->save();
            if ($new != "") {

                $newSaved = $new->save();

            }

            if ($isSaved) {
                $feed = feeds::all();
                $invitee = invite::all();
                $users = addUser::all();
                $savedtests = savedtests::getAnswers();
                $test = questions::all();
                $report = upload::all();
                $assistance = assistance::all();
                if (isset($_POST['gcm'])) {
                    $gcm = addUser::feedGcm($title, $model['_id']);
                }


                return Redirect::to('addFeed')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('feed', $feed);

            } else {
                return array(
                    "code" => "1",
                    "status" => "error"
                );

            }

        }
        if (Input::hasFile('images')) {
            $files = Input::file('images');
            foreach ($files as $file) {
                $destinationPath = public_path() . '/audio/';
                $filename_original = $file->getClientOriginalName();
                $filename = preg_replace('/\s+/', '', $filename_original);
                $file->move($destinationPath, $filename);
                $allowed = array(
                    'mp3',
                    'wav'
                );
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!in_array($ext, $allowed)) {
                    return 'Incorrect file extension';
                }
                if (in_array($ext, $allowed)) {
                    $path = $destinationPath . $filename;
                    $model->feedAudio = $path;
                    if ($new != "") {
                        $new->feedAudio = $path;
                    }

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
                        return array(
                            "code" => "1",
                            "status" => "error"
                        );

                    }

                }
            }
        }
    }

    public static function getFeedIds($input)
    {

        $session = $input['sessionHandle'];
        $uID = $input['uId'];
        $user = addUser::where('uniqueDeviceID', '=', $uID)->where('usrSessionHdl', '=', $session)->get();
        if (count($user) != 0) {

            $arr = array();
            $array = array();

            $feeds = feeds::all();
            foreach ($feeds as $feed) {
                unset($feed['category']);
                unset($feed['summarised']);
                unset($feed['addedBy']);
                unset($feed['feedOwner']);
                unset($feed['feedSchedule']);
                unset($feed['feedType']);
                unset($feed['trending']);
                unset($feed['location']);
                unset($feed['feedDate']);
                unset($feed['feedTitle']);
                unset($feed['feedImage']);
                unset($feed['likeCount']);
                unset($feed['feedContent']);
                unset($feed['feedSource']);
                unset($feed['feedSourceTag']);
                unset($feed['feedSourceTag']);
                unset($feed['feedAudio']);
                unset($feed['created_at']);
                unset($feed['feedGCM']);


            }

            return array(
                "code" => "0",
                "status" => "success",
                "feedIdArray" => $feeds

            );


        } else {
            return array(
                "code" => "1",
                "status" => "error"
            );
        }
    }


}
