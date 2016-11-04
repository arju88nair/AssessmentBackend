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


use App\Http\Requests;

class extra extends Eloquent
{

	protected $connection = "mongodb";
    protected $collection = "categories";

    
    public static function getConstants($input)
    {
        $session = $input['sessionHandle'];
        $user = addUser::where('usrSessionHdl', '=', $session)->get();
        if (!isset($user) || count($user) == 0) {
            return array("resultCode" => "1", "status" => "error", "message" => "User can't be found");


        } else {


            $groupName = "IPL 2015-2016,IPL 2014-2015";
            return array("resultCode" => "0", "status" => "success", "Groups" => $groupName);


        }
    }


    public static function postGroup($input)
    {

        $session = $input['sessionHandle'];
        $groupName = $input['groupName'];
        $user = addUser::where('usrSessionHdl', '=', $session)->first();
        if (!isset($user) || count($user) == 0) {
            return array("resultCode" => "1", "status" => "error", "message" => "User can't be found");


        } else {
           $user->groupName = $groupName;
            $saved=$user->save();

            if ($saved) {
                return array("resultCode" => "0", "status" => "success", "message" => "Updated Successfully");

            }
            else{
                return array("resultCode" => "1", "status" => "error", "message" => "Please Try Again");

            }


        }
    }
	
	
	
	public static function categories($input)
	{
		$model=new self();
		$array=$input['array'];
		$new=array();
		foreach($array as $item)
		{
			array_push($new,$item); 
		}
		$model->categories=$new;
		$model->save();		
		
		
		
	}

}

