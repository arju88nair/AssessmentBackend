<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Date;
use Jenssegers\Mongodb\Schema\Blueprint;
use App\Model\addUser;

class invitees extends Eloquent
{
    //

    protected $connection="mongodb";
    protected $collection="invitees";
    protected $fillable=['name','emailId','invites'];





}
