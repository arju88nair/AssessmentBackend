<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Schema\Blueprint;

class coupon extends Eloquent
{
    //

    protected $connection="mongodb";
    protected $collection="coupon";


    public static function insert($input){


        $model=new self();
        $name=$model->Name=$input['institutionName'];
        $coupon=$model->Coupon=$input['coupon'];
        $date=$model->Date=$input['expiryDate'];
        $model->imageUrl=$input['imageUrl'];

        $coupon_name=$model::where('Coupon', '=', $coupon)->where('Name', '=', $name)->get();
/*        echo $coupon_name;*/
        if(!isset($coupon_name) || count($coupon_name)==0) {

            if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
                $save = $model->save();
                return array("code" => "1", "message" => "Coupon saved");


            } else {
                return array("  code" => "0", "message" => "Invalid date format");
            }
        }
        else{
            return array("code" => "0", "message" => "Saving failed");
        }


    }


    public static function getCoupon(){
        $model=new self();
        return $model::all();
    }
}
