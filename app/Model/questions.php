<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Jenssegers\Mongodb\Schema\Blueprint;
use App\Model\coupon;
use App\Model\addUser;

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
        /* $save = $model->save();
         if ($save) {
             return array("code" => "0", "message" => "Successfully added");
         } else {

             return array("code" => "1", "message" => "Please try again");

         }*/


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
        $check = addUser::where('usrSessionHdl', '=', $sessionHandle)->get();
        if (!isset($check) || count($check) == 0) {
            return array("status" => "error", "resultcode" => "1", "message" => "Incorrect session recieved");
        } else {
            $model = new self();
            $dashboard = $model::all();
            $array = array();
            $main = array();
            foreach ($dashboard as $item) {
                $Id = $item->_id;

                $duration = $item->duration;
                $desciption = $item->desription;
                unset($item->questions);
                unset($item->weightage);
                array_push($array, $Id);
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

                $test->count = "5";
                $test->groupCount = "20";
                $questions = $test["questions"];
                unset($test->questions);
                $test->questions = $questions;

                array_push($array, $test);
            }
            $count = addUser::count();
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
                $multi = $item['mulitpletype'];
                $array['multipleType'] = $multi;
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
                if (isset($item['solutionkey'])) {
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


}
