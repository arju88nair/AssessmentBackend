<?php
/**
 * Created by PhpStorm.
 * User: Himeshu
 * Date: 07-10-2016
 * Time: 11:51
 */

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
use DateTime;

use App\Http\Requests;

class mainFeed extends Eloquent
{

    protected $connection = 'mongodb';
    protected $collection = "mainFeed";

}