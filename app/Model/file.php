<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Date;
use Jenssegers\Mongodb\Schema\Blueprint;
use App\Model\Tests;
class file extends Eloquent
{
    //
    protected $connection="mongodb";
    protected $collection="file";
    protected $fillable=['pathPath'];

}
