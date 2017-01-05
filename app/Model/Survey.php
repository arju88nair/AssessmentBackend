<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Request;
use Date;
use Jenssegers\Mongodb\Schema\Blueprint;
use App\Model\Tests;
use View;
use Redirect;
use Input;
use DateTime;
use Session;
use JonnyW\PhantomJs\Client;

class Survey extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = "survey";
    protected $fillable = ['title', 'text', 'surveyId'];

    public static function addSurvey($input){

        $parameters['title'] = $input['title'];
        $parameters['text'] = $input['text'];
        $parameters['surveyId'] = $input['surveyID'];

        $result = self::create($parameters);

        $sent = self::gcm($parameters['title'], $parameters['text'], $parameters['surveyId']);
        if($sent){
            return true;
        }return false;
    }
    public static function gcm($title, $text,$surveyId)
    {

        define('API_ACCESS_KEY', 'AIzaSyCwBLJ-V5Ad7n0wh-n5i4QRKtN9d4XGWEs');
        $users = addUser::all();
        $array = array();
        foreach ($users as $items) {
            $push = $items['pushNotificationID'];
            array_push($array,$push);
        }
        $registrationIds =array_unique($array);
        $msg = array('title' => $title, "message" => $text,"name"=>$surveyId,"type"=>"Survey");

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
        return $result;

    }
}