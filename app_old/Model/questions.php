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
    /*For whoever may it concern,
 "Long ago all classes lived together in harmony.Then everything changed when poor management attacked.Only the Avatar ,the master of all classes
 could stop them.But when the project needed him most, he vanished. A hundred commits passed.Me and my blackened soul  discovered a new Job. And although my progrmaming skills are great,
  he still has a lot to learn before he's ready to commit more. But I don't believe anyone can save this project."


 But seriously,in the start all classes were well written.They came forth withtoo many changes and reverting back and everything which made this whle  code a living nightmare
  Sorry for whoever lays hand on this.

 Best of luck,
 Rain04


 */
    protected $connection = "mongodb";
    protected $collection = "Dashboard";
    /*    protected $primaryKey = "testId";*/
    protected $hidden = array();
    
    public function toArray()
    {
        $array           = parent::toArray();
        $array['testID'] = $this->id;
        unset($array['_id']);
        return $array;
    }
    
    public static function insert($input)
    {
        $model           = new self();
        $testId          = $model->testName = $input['testName'];
        $model->ImageUrl = $input['ImageUrl'];
        $duration        = $model->duration = $input['duration'];
        $weight          = $model->weightage = $input['weightage'];
        $description     = $model->description = $input['description'];
        $question        = $model->questions = $input['questions'];
        $date            = $model->expiryDate = $input['expiryDate'];
        return $question;
        
        
    }
    
    
    public static function getTestarray()
    {
        $array   = array();
        $model   = new self();
        $allDocs = $model::all();
        
        
        foreach ($allDocs as $item) {
            
            $testId     = $item->_id;
            $testName   = $item->testName;
            $array_name = array(
                $testId => $testName
            );
            array_push($array, $testId);
            
        } //$allDocs as $item
        return $array;
    }
    
    
    public static function getDashboard($input)
    {
        
        $sessionHandle = $input['sessionHandle'];
        $check         = addUser::where('usrSessionHdl', '=', $sessionHandle)->first();
        if (!isset($check) || count($check) == 0) {
            return array(
                "status" => "error",
                "resultcode" => "1",
                "message" => "Incorrect session received"
            );
        } //!isset($check) || count($check) == 0
        else {
            $model     = new self();
            $dashboard = $model::all();
            $array     = array();
            $main      = array();
            foreach ($dashboard as $item) {
                $company = $check['corporateName'];
                if (!isset($company) || count($company) == 0 || $company == '') {
                    $Id         = $item['_id'];
                    $duration   = $item->duration;
                    $desciption = $item->desription;
                    unset($item->questions);
                    unset($item->weightage);
                    array_push($array, $Id);
                } //!isset($company) || count($company) == 0 || $company == ''
                else {
                    
                    $company    = $check['corporateName'];
                    $id_company = $item['ownerName'];
                    if ($id_company == $company) {
                        $Id         = $item['_id'];
                        $duration   = $item->duration;
                        $desciption = $item->desription;
                        unset($item->questions);
                        unset($item->weightage);
                        array_push($array, $Id);
                    } //$id_company == $company
                }
                
            } //$dashboard as $item
            
            $main['testIds']    = $array;
            $main['status']     = "success";
            $main['resultCode'] = "0";
            return $main;
        }
        
        
    }
    
    public static function getTests($input)
    {
        $model   = new self();
        $session = $input['sessionHandle'];
        $testIDs = $input['testIds'];
        $check   = addUser::where('usrSessionHdl', '=', $session)->get();
        if (!isset($check) || count($check) == 0) {
            return array(
                "code" => "1",
                "status" => "error",
                "message" => "Incorrect session"
            );
        } //!isset($check) || count($check) == 0
        else {
            $array = array();
            foreach ($testIDs as $ids) {
                
                $test             = $model::where('_id', "=", $ids)->first();
                $testcount        = savedtests::where('testId', '=', $ids)->get();
                $test->count      = count($testcount);
                $test->groupCount = "20";
                $questions        = $test["questions"];
                unset($test->questions);
                $test->questions = $questions;
                
                array_push($array, $test);
            } //$testIDs as $ids
            $count                      = savedtests::count();
            $resultArray                = array();
            $resultArray['globalCount'] = $count;
            $resultArray['tests']       = $array;
            $resultArray['status']      = "success";
            $resultArray['resultCode']  = "0";
            
            return $resultArray;
            
            
        }
        
        
    }
    
    public function questions()
    {
        return $this->embedsMany('App\Model\keys');
    }
    
    
    public static function addTests($input)
    {
        $model                   = new self();
        $testId                  = $model->testName = $input['testName'];
        $model->ImageUrl         = $input['ImageUrl'];
        $duration                = $model->testDuration = $input['duration'];
        $model->skipFlag         = $input['skipFlag'];
        $model->ownerName        = $input['owner'];
        $model->testStatus       = $input['testStatus'];
        $model->reportFlag       = $input['report'];
        $model->graphFlag        = $input['graph'];
        $weight                  = $model->testType = $input['weightage'];
        $model->corporateUrl     = $input['corporateURL'];
        $model->shortDescription = $input['description'];
        $description             = $model->testDescription = $input['detailedDescription'];
        $model->expiryDate       = $input['expiryDate'];
        $question                = $input['questions'];
        $saved                   = $model->save();
        if ($saved) {
            foreach ($question as $item) {
                $array                     = array();
                $queImage                  = $item['queImage'];
                $array['questionImageUrl'] = $queImage;
                $multi                     = $item['skipFlag'];
                $array['skipFlag']         = $multi;
                $title                     = $item['questiontitle'];
                $array['questiontitle']    = $title;
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
                
                $options          = $item['options'];
                $array['options'] = $options;
                
                $keys = $item['solutionkey'];
                if ($keys == "" || count($keys) == 0) {
                    $keys = ["Not Applicable"]; 
                    $array['solutionkey'] = $keys;
                    
                    
                } //$keys == "" || count($keys) == 0
                else {
                    $array['solutionkey'] = $keys;
                }
                
                if (isset($item['weightage'])) {
                    $array['weightage'] = $item['weightage'];
                } //isset($item['weightage'])
                
                $saved = $model->questions()->create($array);
            } //$question as $item
            return array(
                "code" => "0",
                "status" => "success"
            );
            
        } //$saved
        else {
            
            return array(
                "code" => "1",
                "status" => "error"
            );
            
        }
    }
    
    
    public static function deleteTest($input)
    {
        $model = new self();
        $id    = $input['testId'];
        $test  = $model::find($id)->delete();
        if ($test) {
            return array(
                "resultCode" => "0",
                "status" => "success"
            );
            
        } //$test
        else {
            return array(
                "resultCode" => "1",
                "status" => "error"
            );
            
        }
        
    }
    
    public static function saveEdit($input)
    {
        /*Edit new test*/
        
        $a                        = $_POST['_id'];
        $test                     = new self();
        $model                    = $test::find($a);
        $testId                   = $model->testName = $input['tName'];
        $model->ImageUrl          = $input['ImageUrl'];
        $model->testStatus        = $_POST['status'];
        $model->reportFlag        = $input['report'];
        $model->graphFlag         = $input['graph'];
        $duration                 = $model->testDuration = $input['tDuration'];
        $model->testType          = $_POST['type'];
        $model->corporateUrl      = $input['CURL'];
        $model->ownerName         = $input['owner'];
        $model->shortDescription  = $input['Summary'];
        $description              = $model->testDescription = $input['description'];
        $model->resultDescription = $input['resultDescription'];
        $model->expiryDate        = $input['date'];
        $questionTitle            = $_POST['Qtitle'];
        $options                  = $_POST['qOption'];
        /*        print_r(array_chunk($options,4));*/
        $chunk                    = array_chunk($options, 6);
        $answers                  = $_POST['qAnswer'];
        $qAxis                    = $_POST['axisType'];
        $mFlag                    = $_POST['Mflag'];
        $questionType             = $_POST['QTypes'];
        $qURL                     = $_POST['QURL'];
        $weightage                = $_POST['weightage'];
        $answer                   = array_chunk($answers, 1);
        $array                    = array();
        
        
        foreach ($model->questions as $question) {
            $model->questions()->dissociate($question);
            
        } //$model->questions as $question
        
        $saved = $model->save();
        
        if ($saved) {
            
            $i = 0;
            foreach ($chunk as $items) {
                 if ($answer[$i] == [""]) {
                $array["solutionkey"] = ["Not Applicable"];
                
                } else {
                $array["solutionkey"] = $answer[$i];
                } 
                
                $array["options"]          = $items;
                //  $array["questiontitle"] = array();
                $array["axisType"]         = $qAxis[$i];
                $array["skipFlag"]         = $mFlag[$i];
                $array["questionImageUrl"] = $qURL[$i];
                $array["questionType"]     = $questionType[$i];
                $array["weightage"]        = $weightage[$i];
                $array["questiontitle"]    = $questionTitle[$i];
                $i++;
                
                $saved = $model->questions()->create($array);
            } //$chunk as $items
            
            
            $invitee    = invite::all();
            $users      = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test       = questions::all();
            $report     = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();
            $fulltest   = $model::where('testName', '=', $testId)->first();
            return View::Make('edit')->with('tests', $fulltest)->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);
            
            /*            return  Redirect::to('dashboardAction')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);*/
            
            
        } //$saved
        else {
            return "Failed";
        }
        
    }
    
    public static function newEdit($input)
    {
        
        /* Edit old test*/
        $a                        = $_POST['_id'];
        $test                     = new self();
        $model                    = $test::find($a);
        $testId                   = $model->testName = $input['tName'];
        $model->ImageUrl          = $input['ImageUrl'];
        $model->testStatus        = $_POST['status'];
        $model->reportFlag        = $input['report'];
        $model->graphFlag         = $input['graph'];
        $duration                 = $model->testDuration = $input['tDuration'];
        $model->testType          = $_POST['type'];
        $model->corporateUrl      = $input['CURL'];
        $model->ownerName         = $input['owner'];
        $model->shortDescription  = $input['Summary'];
        $description              = $model->testDescription = $input['description'];
        $model->resultDescription = $input['resultDescription'];
        $model->expiryDate        = $input['date'];
        $questionTitle            = $_POST['Qtitle'];
        $options                  = $_POST['qOption'];
        /*        print_r(array_chunk($options,4));*/
        $chunk                    = array_chunk($options, 6);
        $answers                  = $_POST['qAnswer'];
        $qAxis                    = $_POST['axisType'];
        $mFlag                    = $_POST['Mflag'];
        $questionType             = $_POST['QTypes'];
        $qURL                     = $_POST['QURL'];
        $weightage                = $_POST['weightage'];
        $answer                   = array_chunk($answers, 1);
        $array                    = array();
        
        
        foreach ($model->questions as $question) {
            $model->questions()->dissociate($question);
            
        } //$model->questions as $question
        
        $saved = $model->save();
        
        if ($saved) {
            
            $i = 0;
            foreach ($chunk as $items) {
                $array["options"]          = $items;
                //  $array["questiontitle"] = array();
                $array["solutionkey"]      = $answer[$i];
                $array["axisType"]         = $qAxis[$i];
                $array["skipFlag"]         = $mFlag[$i];
                $array["questionType"]     = $questionType[$i];
                $array["questionImageUrl"] = $qURL[$i];
                $array["weightage"]        = $weightage[$i];
                $array["questiontitle"]    = $questionTitle[$i];
                $i++;
                
                $saved = $model->questions()->create($array);
            } //$chunk as $items
            
            
            $invitee    = invite::all();
            $users      = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test       = questions::all();
            $report     = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();
            
            
            return View::Make('dashboard')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);
            
            /*            return  Redirect::to('dashboardAction')->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests);*/
            
            
        } //$saved
        else {
            return "Failed";
        }
        
    }
    
    
    public static function addTest($input)
    {
        
        $model                    = new self();
        $testId                   = $model->testName = $input['tName'];
        $model->ImageUrl          = $input['ImageUrl'];
        $duration                 = $model->testDuration = $input['tDuration'];
        $model->testType          = $_POST['flag'];
        $model->testStatus        = $_POST['status'];
        $model->reportFlag        = $input['report'];
        $model->graphFlag         = $input['graph'];
        $model->ownerName         = $input['owner'];
        $model->corporateUrl      = $input['CURL'];
        $model->shortDescription  = $input['Summary'];
        $description              = $model->testDescription = $input['description'];
        $model->resultDescription = $input['resultDescription'];
        $model->expiryDate        = $input['date'];
        $questionTitle            = $_POST['Qtitle'];
        $options                  = $_POST['qOption'];
        $chunk                    = array_chunk($options, 6);
        $answers                  = $_POST['qAnswer'];
        $questionType             = $_POST['QTypes'];
        $mFlag                    = $_POST['Mflag'];
        $qAxis                    = $_POST['axisType'];
        $qURL                     = $_POST['QURL'];
        $weightage                = $_POST['weightage'];
        $answer                   = array_chunk($answers, 1);
        $array                    = array();
        
        
        $saved = $model->save();
        if ($saved) {
            
            
            $i = 0;
            foreach ($chunk as $items) {
                 if ($answer[$i] == [""]) {
                $array["solutionkey"] = ["Not Applicable"];
                
                } else {
                $array["solutionkey"] = $answer[$i];
                } 
                $array["solutionkey"] = $answer[$i];
                
                
                $array["options"] = $items;
                
                $array["axisType"]         = $qAxis[$i];
                $array["questionType"]     = $questionType[$i];
                $array["skipFlag"]         = $mFlag[$i];
                $array["questionImageUrl"] = $qURL[$i];
                $array["weightage"]        = $weightage[$i];
                $array["questiontitle"]    = $questionTitle[$i];
                $i++;
                
                $saved = $model->questions()->create($array);
            } //$chunk as $items
            $invitee    = invite::all();
            $users      = addUser::all();
            $savedtests = savedtests::getAnswers();
            $test       = questions::all();
            $report     = upload::where('status', '=', 'Pending')->get();
            $assistance = assistance::all();
            $fulltest   = $model::where('testName', '=', $testId)->first();
            $full_id    = $fulltest['_id'];
            addUser::testGcm($testId);
            return View::Make('edit')->with('tests', $fulltest)->with('test', $test)->with('invitee', $invitee)->with('users', $users)->with('report', $report)->with('assistance', $assistance)->with('savedtests', $savedtests)->with('full_id', $full_id);
            
        } //$saved
        else {
            return "Failed";
        }
        
    }
    
    
    public static function dashboard($input)
    {
        
        $session = $input['sessionHandle'];
        $check   = addUser::where('usrSessionHdl', '=', $session)->first();
        if (isset($check) || count($check) != 0) {
            $saved = savedtests::all();
            $array = array();
            foreach ($saved as $item) {
                
                array_push($array, $item['testId']);
            } //$saved as $item
            $count = array_count_values($array); //Counts the values in the array, returns associatve array
            arsort($count); //Sort it from highest to lowest
            $keys      = array_keys($count); //Split the array so we can find the most occuring key
            $new       = array_slice($keys, 0, 5);
            $testArray = array();
            foreach ($new as $key) {
                
                $test = questions::where('_id', "=", $key)->first();
                if (count($test) != 0 || $test != "") {
                    $testcount        = savedtests::where('testId', '=', $key)->get();
                    $test->count      = count($testcount);
                    $test->groupCount = "20";
                    $questions        = $test["questions"];
                    unset($test->questions);
                    $test->questions = $questions;
                    array_push($testArray, $test);
                } //count($test) != 0 || $test != ""
                
            } //$new as $key
            $feeds     = feeds::all();
            $feedCount = feedCount::all();
            $feedArray = array();
            foreach ($feeds as $item) {
                
                if ($item['trending'] == "Yes") {
                    array_push($feedArray, $item);
                } //$item['trending'] == "Yes"
                
                
                
            } //$feeds as $item
            
            
            /* foreach($feedCount as $feed)
            {
            array_push($feedArray,$feed['feedId']);
            }
            
            $countFeed = array_count_values($feedArray);//Counts the values in the array, returns associatve array
            arsort($countFeed);//Sort it from highest to lowest
            $feedKeys = array_keys($countFeed);//Split the array so we can find the most occuring key
            $feedNew= array_slice($feedKeys, 0, 5);*/
            
            $main                = array();
            $count               = savedtests::count();
            $main['globalCount'] = $count;
            $main['status']      = "success";
            $main['resultCode']  = "0";
            $main['testArray']   = $testArray;
            $main['feedArray']   = $feedArray;
            return $main;
            
        } //isset($check) || count($check) != 0
        else {
            return array(
                "status" => "error",
                "resultcode" => "1",
                "message" => "Incorrect session received"
            );
            
        }
        
    }
    
    
}