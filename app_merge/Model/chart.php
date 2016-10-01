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


use App\Http\Requests;

class chart extends Eloquent
{
    //
    
    protected $connection = 'mongodb';
    protected $collection = "chart";
    
    
    
    public static function chart($input)
    {
        $model          = new self();
        $axis           = $input['axes'];
        $model->axes    = $axis;
        $scores         = $input['scores'];
        $model->scores  = $scores;
        $session        = $input['sessionHandle'];
        $model->session = $session;
        $testId         = $input['testId'];
        $model->testId  = $testId;
        $saved          = $model->save();
        if ($saved) {
            return array(
                "code" => "0",
                "status" => "success",
                "message" => "Saved"
            );
        } //$saved
        else {
            return array(
                "code" => "1",
                "status" => "error"
            );
            
        }
        
    }
}

