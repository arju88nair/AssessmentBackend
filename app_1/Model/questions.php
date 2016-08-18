<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Jenssegers\Mongodb\Schema\Blueprint;
use App\Model\coupon;
use App\Model\addUser;
use View;
use Redirect;
use Input;


class questions extends Eloquent
{
    //
    protected $connection = "mongodb";
    protected $collection = "Dashboard";
    /*    protected $primaryKey = "testId";*/
    protected $hidden = array();

    public function toArray()
    {
        $array = parent::toArray();
        $array['testID'] = $this->id;
        unset($array['_id']);
        return $array;
    }

    public static function insert($input)
    {
        $model = new self();
        $testId = $model->testName = $input['testName'];
        $model->ImageUrl = $input['ImageUrl'];
        $duration = $model->duration = $input['duration'];
        $weight = $model->weightage = $input['weightage'];
        $description = $model->description = $input['description'];
        $question = $model->questions = $input['questions'];
        $date = $model->expiryDate = $input['expiryDate'];
        return $question;


    }


    public static function getTestarray()
    {
        $array = array();
        $model = new self();
        $allDocs = $model::all();


        foreach ($allDocs as $item) {

            $testId = $item->_id;
            $testName = $item->testName;
            $array_name = array($testId => $testName);
            array_push($array, $testId);

        }
        return $array;
    }


    public static function getDashboard($input)
    {

        $sessionHandle = $input['sessionHandle'];
        $check = addUser::where('usrSessionHdl', '=', $sessionHandle)->first();
        if (!isset($check) || count($check) == 0) {
            return array("status" => "error", "resultcode" => "1", "message" => "Incorrect session received");
        } else {
            $model = new self();
            $dashboard = $model::all();
            $array = array();
            $main = array();
            foreach ($dashboard as $item) {
                $company = $check['corporateName'];
                if (!isset($company) || count($company) == 0 || $company == '') {
                    $Id = $item['_id'];
                    $duration = $item->duration;
                    $desciption = $item->desription;
                    unset($item->questions);
                    unset($item->weightage);
                    array_push($array, $Id);
                } else {

                    $company = $check['corporateName'];
                    $id_company = $item['ownerName'];
                    if ($id_company == $company) {
                        $Id = $item['_id'];
                        $duration = $item->duration;
                        $desciption = $item->desription;
                        unset($item->questions);
                        unset($item->weightage);
                        array_push($array, $Id);
                    }
                }

            }

            $main['testIds'] = $array;
            $main['status'] = "success";
            $main['resultCode'] = "0";
            return $main;
        }


    }

    public static function getTests($input)
    {
        $model = new self();
        $session = $input['sessionHandle'];
        $testIDs = $input['testIds'];
        $check = addUser::where('usrSessionHdl', '=', $session)->get();
        if (!isset($check) || count($check) == 0) {
            return array("code" => "1", "status" => "error", "message" => "Incorrect session");
        } else {
            $array = array();
            foreach ($testIDs as $ids) {

                $test = $model::where('_id', "=", $ids)->first();
                $testcount = savedtests::where('testId', '=', $ids)->get();
                $test->count = count($testcount);
                $test->groupCount = "20";
                $questions = $test["questions"];
                unset($test->questions);
                $test->questions = $questions;

                array_push($array, $test);
            }
            $count = savedtests::count();
            $resultArray = array();
            $resultArray['globalCount'] = $count;
            $resultArray['tests'] = $array;
            $resultArray['status'] = "success";
            $resultArray['resultCode'] = "0";

            return $resultArray;


        }


    }

    public function questions()
    {
        return $this->embedsMany('App\Model\keys');
    }


    public static function addTests($input)
    {
        $model = new self();
        $testId = $model->testName = $input['testName'];
        $model->ImageUrl = $input['ImageUrl'];
        $duration = $model->testDuration = $input['duration'];
        $model->skipFlag = $input['skipFlag'];
        $model->ownerName = $input['owner'];
        $model->testStatus = $input['testStatus'];
		$model->reportFlag=$input['report'];
		$model->graphFlag=$input['graph'];
        $weight = $model->testType = $input['weightage'];
        $model->corporateUrl = $input['corporateURL'];
        $model->shortDescription = $input['description'];
        $description = $model->testDescription = $input['detailedDescription'];
        $model->expiryDate = $input['expiryDate'];
        $question = $input['questions'];
        $saved = $model->save();
        if ($saved) {
            foreach ($question as $item) {
                $array = array();
                $queImage = $item['queImage'];
                $array['questionImageUrl'] = $queImage;
                $multi = $item['skipFlag'];
                $array['skipFlag'] = $multi;
                $title = $item['questiontitle'];
                $array['questiontitle'] = $title;
                /*$aa = $item['answerkeyA'];
                if (isset($item['answerkeyA'])) {
                    $array['answerkeyA'] = $aa;
                }
                $ab = $item['answerkeyB'];
                if (isset($item['answerkeyB'])) {
                    $array['answerkeyB'] = $ab;
                }
                $ac = $item['answerkeyC'];
                if (isset($item['answerkeyC'])) {
                    $array['answerkeyC'] = $ac;
                }
                $ad = $item['answerkeyD'];
                if (isset($item['answerkeyD'])) {
                    $array['answerkeyD'] = $ad;
                }*/

                $options = $item['options'];
                $array['options'] = $options;

                $keys = $item['solutionkey'];
                if ($keys == "" || count($keys) == 0) {
                    $keys = ["Not Applicable"];
                    $array['solutionkey'] = $keys;


                } else {
                    $array['solutionkey'] = $keys;
                }

                if (isset($item['weightage'])) {
                    $array['weightage'] = $item['weightage'];
                }

                $saved = $model->questions()->create($array);
            }
            return array("code" => "0", "status" => "success");

        } else {

            return array("code" => "1", "status" => "error");

        }
    }


    public static function deleteTest($input)
    {
        $model = new self();
        $id = $input['testId'];
        $test = $model::find($id)->delete();
        if ($test) {
            return array("resultCode" => "0", "status" => "success");

        } else {
            return array("resultCode" => "1", "status" => "error");

        }

    }

    public static function saveEdit($input)
    {
<<<<<<< HEAD
        /*Edit new test*/

=======
<<<<<<< HEAD
        /*Edit new test*/

=======
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980
        $a = $_POST['_id'];
        $test = new self();
        $model = $test::find($a);
        $testId = $model->testName = $input['tName'];
        $model->ImageUrl = $input['ImageUrl'];
        $model->testStatus = $_POST['status'];
		$model->reportFlag=$input['report'];
		$model->graphFlag=$input['graph'];
        $duration = $model->testDuration = $input['tDuration'];
        $model->testType = $_POST['type'];
        $model->corporateUrl = $input['CURL'];
        $model->ownerName = $input['owner'];
        $model->shortDescription = $input['Summary'];
        $description = $model->testDescription = $input['description'];
<<<<<<< HEAD
        $model->resultDescription = $input['resultDescription'];
=======
<<<<<<< HEAD
        $model->resultDescription = $input['resultDescription'];
=======
        $model->resultDescription=$input['resultDescription'];
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980
        $model->expiryDate = $input['date'];
        $questionTitle = $_POST['Qtitle'];
        $options = $_POST['qOption'];
        /*        print_r(array_chunk($options,4));*/
        $chunk = array_chunk($options, 6);
        $answers = $_POST['qAnswer'];
<<<<<<< HEAD
        $qAxis = $_POST['axisType'];
=======
<<<<<<< HEAD
        $qAxis = $_POST['axisType'];
=======
        $qAxis=$_POST['axisType'];
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980
        $mFlag = $_POST['Mflag'];
        $questionType=$_POST['QTypes'];
        $qURL = $_POST['QURL'];
        $weightage = $_POST['weightage'];
        $answer = array_chunk($answers, 1);
        $array = array();


        foreach ($model->questions as $question) {
            $model->questions()->dissociate($question);

        }

        $saved = $model->save();

        if ($saved) {

            $i = 0;
            foreach ($chunk as $items) {
<<<<<<< HEAD
                if ($answer[$i] == [""]) {

                    $array["solutionkey"] = ["Not Applicable"];
=======
<<<<<<< HEAD
                if ($answer[$i] == [""]) {
                    $array["solutionkey"] = ["Not Applicable"];

                } else {
                    $array["solutionkey"] = $answer[$i];
                }

                $array["options"] = $items;
                //  $array["questiontitle"] = array();
=======
				if($answer[$i]==[""]){
				$array["solutionkey"] = ["Not Applicable"];
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980

                } else {
                    $array["solutionkey"] = $answer[$i];
                }

                $array["options"] = $items;
<<<<<<< HEAD
                //  $array["questiontitle"] = array();
=======
              //  $array["questiontitle"] = array();
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980
                $array["axisType"] = $qAxis[$i];
                $array["skipFlag"] = $mFlag[$i];
                $array["questionImageUrl"] = $qURL[$i];
                $array["questionType"]=$questionType[$i];
                $array["weightage"] = $weightage[$i];
                $array["questiontitle"] = $questionTitle[$i];
                $i++;

                $saved = $model->questions()->create($array);
            }


            $invitee = invite::all();
            $users = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test = questions::all();
            $report = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();
<<<<<<< HEAD
            $fulltest = $model::where('testName', '=', $testId)->first();
=======
<<<<<<< HEAD
            $fulltest = $model::where('testName', '=', $testId)->first();
=======
            $fulltest=$model::where('testName','=',$testId)->first();
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980
            return View::Make('edit')->with('tests', $fulltest)->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);

            /*            return  Redirect::to('dashboardAction')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);*/


        } else {
            return "Failed";
        }

    }

    public static function newEdit($input)
    {
<<<<<<< HEAD

        /* Edit old test*/
=======
<<<<<<< HEAD

        /* Edit old test*/
=======
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980
        $a = $_POST['_id'];
        $test = new self();
        $model = $test::find($a);
        $testId = $model->testName = $input['tName'];
        $model->ImageUrl = $input['ImageUrl'];
        $model->testStatus = $_POST['status'];
		$model->reportFlag=$input['report'];
		$model->graphFlag=$input['graph'];
        $duration = $model->testDuration = $input['tDuration'];
        $model->testType = $_POST['type'];
        $model->corporateUrl = $input['CURL'];
        $model->ownerName = $input['owner'];
        $model->shortDescription = $input['Summary'];
        $description = $model->testDescription = $input['description'];
<<<<<<< HEAD
        $model->resultDescription = $input['resultDescription'];
=======
<<<<<<< HEAD
        $model->resultDescription = $input['resultDescription'];
=======
        $model->resultDescription=$input['resultDescription'];
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980
        $model->expiryDate = $input['date'];
        $questionTitle = $_POST['Qtitle'];
        $options = $_POST['qOption'];
        /*        print_r(array_chunk($options,4));*/
        $chunk = array_chunk($options, 6);
        $answers = $_POST['qAnswer'];
<<<<<<< HEAD
        $qAxis = $_POST['axisType'];
=======
<<<<<<< HEAD
        $qAxis = $_POST['axisType'];
=======
        $qAxis=$_POST['axisType'];
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980
        $mFlag = $_POST['Mflag'];
        $questionType=$_POST['QTypes'];
        $qURL = $_POST['QURL'];
        $weightage = $_POST['weightage'];
        $answer = array_chunk($answers, 1);
        $array = array();


        foreach ($model->questions as $question) {
            $model->questions()->dissociate($question);

        }

        $saved = $model->save();

        if ($saved) {

            $i = 0;
            foreach ($chunk as $items) {
				if ($answer[$i] == [""]) {
                    $array["solutionkey"] = ["Not Applicable"];

                } else {
                    $array["solutionkey"] = $answer[$i];
                }

                $array["options"] = $items;
                //  $array["questiontitle"] = array();
               
                $array["axisType"] = $qAxis[$i];
                $array["skipFlag"] = $mFlag[$i];
                $array["questionType"]=$questionType[$i];
                $array["questionImageUrl"] = $qURL[$i];
                $array["weightage"] = $weightage[$i];
                $array["questiontitle"] = $questionTitle[$i];
                $i++;

                $saved = $model->questions()->create($array);
            }


            $invitee = invite::all();
            $users = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test = questions::all();
            $report = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();

            return View::Make('dashboard')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);

            /*            return  Redirect::to('dashboardAction')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);*/


        } else {
            return "Failed";
        }

    }


    public static function addTest($input)
    {

        $model = new self();
        $testId = $model->testName = $input['tName'];
        $model->ImageUrl = $input['ImageUrl'];
        $duration = $model->testDuration = $input['tDuration'];
        $model->testType = $_POST['flag'];
        $model->testStatus = $_POST['status'];
		$model->reportFlag=$input['report'];
		$model->graphFlag=$input['graph'];
        $model->ownerName = $input['owner'];
        $model->corporateUrl = $input['CURL'];
        $model->shortDescription = $input['Summary'];
        $description = $model->testDescription = $input['description'];
<<<<<<< HEAD
        $model->resultDescription = $input['resultDescription'];
=======
<<<<<<< HEAD
        $model->resultDescription = $input['resultDescription'];
=======
        $model->resultDescription=$input['resultDescription'];
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980
        $model->expiryDate = $input['date'];
        $questionTitle = $_POST['Qtitle'];
        $options = $_POST['qOption'];
        $chunk = array_chunk($options, 6);
        $answers = $_POST['qAnswer'];
        $questionType=$_POST['QTypes'];
        $mFlag = $_POST['Mflag'];
<<<<<<< HEAD
        $qAxis = $_POST['axisType'];
=======
<<<<<<< HEAD
        $qAxis = $_POST['axisType'];
=======
        $qAxis=$_POST['axisType'];
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980
        $qURL = $_POST['QURL'];
        $weightage = $_POST['weightage'];
        $answer = array_chunk($answers, 1);
        $array = array();
<<<<<<< HEAD

=======
<<<<<<< HEAD


=======
		
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980
        $saved = $model->save();
        if ($saved) {


            $i = 0;
<<<<<<< HEAD
            foreach ($chunk as $items) {
                if ($answer[$i] == [""]) {
                    $array["solutionkey"] = ["Not Applicable"];
=======
<<<<<<< HEAD
            foreach ($chunk as $items) {
                if ($answer[$i] == [""]) {
                    $array["solutionkey"] = ["Not Applicable"];

                } else {
                    $array["solutionkey"] = $answer[$i];
                }
                $array["solutionkey"] = $answer[$i];


                $array["options"] = $items;

=======
            foreach ($chunk as $items) {	
			if($answer[$i]==[""]){
							$array["solutionkey"] = ["Not Applicable"];
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980

                } else {
                    $array["solutionkey"] = $answer[$i];
                }


                $array["options"] = $items;
<<<<<<< HEAD

=======
               
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980
                $array["axisType"] = $qAxis[$i];
                $array["questionType"]=$questionType[$i];
                $array["skipFlag"] = $mFlag[$i];
                $array["questionImageUrl"] = $qURL[$i];
                $array["weightage"] = $weightage[$i];
                $array["questiontitle"] = $questionTitle[$i];
                $i++;

                $saved = $model->questions()->create($array);
            }
            $invitee = invite::all();
            $users = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test = questions::all();
            $report = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980
            $fulltest = $model::where('testName', '=', $testId)->first();
            $full_id = $fulltest['_id'];
            addUser::testGcm($testId);
            return View::Make('edit')->with('tests', $fulltest)->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('full_id', $full_id);
<<<<<<< HEAD
=======
=======
            $fulltest=$model::where('testName','=',$testId)->first();
            $full_id=$fulltest['_id'];
            return View::Make('edit')->with('tests', $fulltest)->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('full_id',$full_id);
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
>>>>>>> feffef1a55191771322ad404c669d9cc4d269980

        } else {
            return "Failed";
        }

    }


    public static function dashboard($input)
    {

        $session = $input['sessionHandle'];
        $check = addUser::where('usrSessionHdl', '=', $session)->first();
        if (isset($check) || count($check) != 0) {
            $saved = savedtests::all();
            $array = array();
            foreach ($saved as $item) {

                array_push($array, $item['testId']);
            }
            $count = array_count_values($array);//Counts the values in the array, returns associatve array
            arsort($count);//Sort it from highest to lowest
            $keys = array_keys($count);//Split the array so we can find the most occuring key
            $new= array_slice($keys, 0, 5);
            $testArray = array();
            foreach ($new as $key) {

                $test = questions::where('_id', "=", $key)->first();
                if(count($test)!=0||$test!="") {
                     $testcount = savedtests::where('testId', '=', $key)->get();
                     $test->count = count($testcount);
                     $test->groupCount = "20";
                     $questions = $test["questions"];
                     unset($test->questions);
                     $test->questions = $questions;
                     array_push($testArray, $test);
                }

            }
            $feeds = feeds::all();
            $feedCount=feedCount::all();
            $feedArray=array();
            foreach($feeds as $item)
            {

              if($item['trending']=="Yes")
              {
                  array_push($feedArray,$item);
              }



            }


            /* foreach($feedCount as $feed)
            {
                array_push($feedArray,$feed['feedId']);
            }

            $countFeed = array_count_values($feedArray);//Counts the values in the array, returns associatve array
            arsort($countFeed);//Sort it from highest to lowest
            $feedKeys = array_keys($countFeed);//Split the array so we can find the most occuring key
            $feedNew= array_slice($feedKeys, 0, 5);*/

            $main = array();
            $count = savedtests::count();
            $main['globalCount'] = $count;
            $main['status'] = "success";
            $main['resultCode'] = "0";
            $main['testArray'] = $testArray;
            $main['feedArray'] = $feedArray;
            return $main;

        } else {
            return array("status" => "error", "resultcode" => "1", "message" => "Incorrect session received");

        }

    }


}
