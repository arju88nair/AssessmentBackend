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


class feedCount extends Eloquent
{
    //
    protected $connection = "mongodb";
    protected $collection = "feed_counts";
    
    
    public static function updateCount($input)
    {
        
        $model        = new self();
        $session      = $input['sessionHandle'];
        $feedId       = $input['feedId'];
        $feedBookmark = $input['feedBookmark'];
        $feedAudio    = $input['feedAudio'];
        $check        = addUser::where('usrSessionHdl', '=', $session)->first();
        if (isset($check) || count($check) != 0) {
            $feed = feeds::where('_id', '=', $feedId)->first();
            if (isset($feed) || count($feed) != 0) {
                
                $countCheck = $model::where('userId', '=', $session)->where('feedId', '=', $feedId)->get();
                if (!isset($countCheck) || count($countCheck) == 0) {
                    
                    $model->userId    = $session;
                    $model->feedId    = $feedId;
                    $model->feedTitle = $feed['feedTitle'];
                    $saved            = $model->save();
                    if ($saved) {
                        return array(
                            "status" => "success",
                            "resultcode" => "0",
                            "message" => "Successfully saved"
                        );
                        
                    } //$saved
                    else {
                        return array(
                            "status" => "error",
                            "resultcode" => "1",
                            "message" => "Please try again"
                        );
                        
                    }
                    
                } //!isset($countCheck) || count($countCheck) == 0
                else {
                    return array(
                        "status" => "error",
                        "resultcode" => "1",
                        "message" => "Already viewed"
                    );
                    
                }
            } //isset($feed) || count($feed) != 0
            else {
                return array(
                    "status" => "error",
                    "resultcode" => "1",
                    "message" => "Incorrect feed Id received"
                );
                
            }
            
            
        } //isset($check) || count($check) != 0
        else {
            return array(
                "status" => "error",
                "resultcode" => "1",
                "message" => "Incorrect session received"
            );
            
        }
    }
    
    
    
    public static function userCount($input)
    {
        
        $id               = $input['sessionHandle'];
        $uid              = $input['uId'];
        $count            = $input['feedCount'];
        $guest            = addUser::where('uniqueDeviceID', '=', $input['uId'])->where('usrSessionHdl', '=', 'Guest')->first();
        $guest->feedCount = $count;
        $is               = $guest->save();
        if ($is) {
            return array(
                "status" => "success",
                "resultCode" => "1",
                "message" => "Updated"
            );
        } else {
            return array(
                "status" => "error",
                "resultCode" => "0",
                "message" => "Try again you scapegoat"
            );
            
        }
        
        
    }
}
