<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Support\Facades\Log;

class gcm extends Eloquent
{
    //

    protected $connection = "mongodb";
    protected $collection = "gcm";


}
