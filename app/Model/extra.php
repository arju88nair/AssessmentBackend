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
	
	public static function categories($input)
	{
        self::query()->delete();
		$model=new self();
		$array=$input['array'];
		$new=array();
		foreach($array as $item)
		{
			array_push($new,$item);
		}
		$model->categories=$new;
		$result = $model->save();

        $statusCode = config('StatusCodes.STATUS_OK');
        return array('code'=>'0','statusCode'=>$statusCode,'message'=>'Categories added successfully','details'=>array('addedCategories'=>$model));
	}
}

