<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Date;
use Jenssegers\Mongodb\Schema\Blueprint;
use App\Model\Tests;

class keys extends Eloquent
{
    //

    protected $connection="mongodb";
    protected $collection="keys";
    protected $fillable=['questions','options','weightage','questionType','questionImageUrl','skipFlag','axisType','questiontitle','answerkeyA','answerkeyB','answerkeyC','answerkeyD','solutionkey'];


    public function toArray()
    {
        $array = parent::toArray();
        $array['queId'] = $this->id;
        unset($array['_id']);
        return $array;
    }





}
