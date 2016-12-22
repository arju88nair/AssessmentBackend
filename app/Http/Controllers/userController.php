<?php

namespace App\Http\Controllers;

use App\Model\comments;
use App\Model\coupon;
use App\Model\extra;
use App\Model\feedCount;
use App\Model\feeds;
use App\Model\like;
use App\Model\savedtests;
use DateTime;
use App\Model\addUser;
use App\Model\invite;
use App\Model\admin;
use App\Model\assistance;
use App\Model\questions;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Model\Tests;
use App\Model\upload;
use App\Model\chart;
use Symfony\Component\HttpFoundation\RedirectResponse;
use View;
use Redirect;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Date;
use Jenssegers\Mongodb\Schema\Blueprint;


class userController extends Controller
{
    //

    public function addUser(Request $request)
    {
       /*  if (!$request->has('authType')) {
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'AuthType is missing'))->header('Content-Type', 'application/json');
        }
        if ($request['authType'] != "Guest")
        {
            if (!$request->has('userID')) {
                $statusCode = config('StatusCodes.MISSING_PARAMETER');
                return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'User ID is missing'))->header('Content-Type', 'application/json');
            }
            if (!$request->has('password')) {
                $statusCode = config('StatusCodes.MISSING_PARAMETER');
                return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Password is missing'))->header('Content-Type', 'application/json');
            }
            if (!$request->has('imageUrl')) {
                $statusCode = config('StatusCodes.MISSING_PARAMETER');
                return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Image URL is missing'))->header('Content-Type', 'application/json');
            }
            if (!$request->has('clientPlf')) {
                $statusCode = config('StatusCodes.MISSING_PARAMETER');
                return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Client Plf is missing'))->header('Content-Type', 'application/json');
            }
            if (!$request->has('userName')) {
                $statusCode = config('StatusCodes.MISSING_PARAMETER');
                return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'User name is missing'))->header('Content-Type', 'application/json');
            }
            if (!$request->has('deviceType')) {
                $statusCode = config('StatusCodes.MISSING_PARAMETER');
                return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Device type is missing'))->header('Content-Type', 'application/json');
            }
            if (!$request->has('appVersion')) {
                $statusCode = config('StatusCodes.MISSING_PARAMETER');
                return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'App version is missing'))->header('Content-Type', 'application/json');
            }
            if (!$request->has('uniqueDeviceID')) {
                $statusCode = config('StatusCodes.MISSING_PARAMETER');
                return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Unique DeviceID is missing'))->header('Content-Type', 'application/json');
            }
            if (!$request->has('pushNotificationID')) {
                $statusCode = config('StatusCodes.MISSING_PARAMETER');
                return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'PushNotificationID is missing'))->header('Content-Type', 'application/json');
            }
            if (!$request->has('location')) {
                $statusCode = config('StatusCodes.MISSING_PARAMETER');
                return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Location is missing'))->header('Content-Type', 'application/json');
            }
        }
        if (!$request->has('uniqueDeviceID')) {
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Unique DeviceID is missing'))->header('Content-Type', 'application/json');
        } */
        return addUser::userCheck($request->all());
    }

    /*public function test(Request $request)
    {
        return addUser::test($request->all());
    }*/

    public function login(Request $request)
    {
        return View::make('login')->with('message', 'Blah');;
    }

    public function admin(Request $request)
    {
        return admin::index($request->all());
    }

    public function getdetails(Request $request)
    {
        return admin::login($request->all());
    }

    public function dashboard(Request $request)
    {
        return admin::dashboard($request->all());
    }

    public function saveEdit(Request $request)
    {
        return questions::saveEdit($request->all());
    }

    public function addFeed(Request $request)
    {
        return admin::addFeed($request->all());
    }

    public function feedCount(Request $request)
    {
        return feedCount::updateCount($request->all());
    }

    public function searchTable(Request $request)
    {
        return admin::searchTable($request->all());
    }

    public function like(Request $request)
    {
        if (!$request->has('session')) {
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'session Handle is missing'))->header('Content-Type', 'application/json');
        }
        if (!$request->has('uID')) {
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Unique ID is missing'))->header('Content-Type', 'application/json');
        }
        if (!$request->has('feedId')) {
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Feed ID is missing'))->header('Content-Type', 'application/json');
        }
        return like::like($request->all());
    }

    public function unlike(Request $request)
    {
        if (!$request->has('session')) {
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'session Handle is missing'))->header('Content-Type', 'application/json');
        }
        if (!$request->has('uID')) {
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Unique ID is missing'))->header('Content-Type', 'application/json');
        }
        if (!$request->has('feedId')) {
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Feed ID is missing'))->header('Content-Type', 'application/json');
        }
        return like::unlike($request->all());
    }

    public function addCategories(Request $request)
    {
        if (!$request->has('array')) {
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Category is missing'))->header('Content-Type', 'application/json');
        }
        return extra::categories($request->all());
    }


    public function getFeedIds(Request $request)
    {
        if (!$request->has('sessionHandle')) {
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'session Handle is missing'))->header('Content-Type', 'application/json');
        }
        return feeds::getFeedIds($request->all());
    }

    /*  public function userCount(Request $request)
      {

          return feedCount::userCount($request->all());
      }*/

    public function comments(Request $request)
    {
        if (!$request->has('sessionHandle')) {
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'session Handle is missing'))->header('Content-Type', 'application/json');
        }
        if (!$request->has('uId')) {
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Unique ID is missing'))->header('Content-Type', 'application/json');
        }
        if (!$request->has('comment')) {
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code' => '1', "status" => "failure", 'statusCode' => $statusCode, 'message' => 'Comment is missing'))->header('Content-Type', 'application/json');
        }
        return comments::comments($request->all());
    }

    public function redirect(Request $request)
    {
        return redirect()->away('http://get.mikrolearn.com/');
    }

}