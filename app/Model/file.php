<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Date;
use Jenssegers\Mongodb\Schema\Blueprint;
class file extends Eloquent
{
    //
    protected $connection="mongodb";
    protected $collection="file";
    protected $fillable=['filePath'];

}
