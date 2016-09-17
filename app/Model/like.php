<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Schema\Blueprint;

class like extends Eloquent
{
    //

    protected $connection="mongodb";
    protected $collection="like";


    public static function like($input){

	$model=new self();
	$session=$input['session'];
	$user = addUser::where('usrSessionHdl', '=', $session)->first();	
	  if (!isset($user) || count($user) == 0) {
            return array("resultCode" => "1", "status" => "error", "message" => "User can't be found");


        } else {
			
			$feedId=$input['feedId'];
			$check=$model::where('feedId','=',$feedId)->where('session','=',$session)->get();
			
			if (!isset($check) || count($check) == 0) {
				if(isset($user['liked']))
					{
						$ar=$user['liked'];
						if(in_array($feedId,$user['liked'])){
							return array("resultCode" => "1", "status" => "error", "message" => "Already liked");
						}
						else{
							array_push($ar,$feedId);
							$user->liked=$ar;
							$user->save();
						}
						
					}
					else{
		
						};
				$model->feedId=$feedId;
				$model->session=$session;
				$saved=$model->save();
				if($saved){
					
					return array("resultCode" => "0", "status" => "success", "message" => "Successfully Liked");
 
				          }
						  
				else      {
					
					return array("resultCode" => "1", "status" => "error", "message" => "Already liked");

				          }
						  
			}
			else{
				
					return array("resultCode" => "1", "status" => "error", "message" => "Feed Can't be found.Try again");

			}
			
		}

    }


    public static function unlike($input){
        
		$model=new self();
		$session=$input['session'];
		$user = addUser::where('usrSessionHdl', '=', $session)->first();
		
	  if (!isset($user) || count($user) == 0) {
            return array("resultCode" => "1", "status" => "error", "message" => "User can't be found");


        } else {
			
			$feedId=$input['feedId'];
			$check=$model::where('feedId','=',$feedId)->where('session','=',$session)->first();
			
			if (!isset($check) || count($check) == 0) {
												return array("resultCode" => "1", "status" => "error", "message" => "Already Unliked");

			}
			else{
				
				$saved=$check->delete();
				if($saved){
					$ar=$user['liked'];
		
		$key= array_search($input['feedId'],$user['liked']);
		unset($ar[$key]);
		$user->liked=$ar;
		$user->save();
					return array("resultCode" => "0", "status" => "success", "message" => "Successfully Unliked");
 
				}
				else{
					return array("resultCode" => "1", "status" => "error", "message" => "Already unliked");

				}

			}
			
		}

    }
}
