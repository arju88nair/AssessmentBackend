<?php

namespace App\Http\Controllers;

use App\Model\admin;
use App\Model\feeds;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\View;
use Session;
use Redirect;
use App\Model\Survey;

class DashboardController extends Controller
{

    public function getFeeds(Request $request)
    {
        if(!$request->has('sessionHandle')){
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code'=>'1',"status" => "failure",'statusCode'=>$statusCode,'message'=>'session Handle is missing'))->header('Content-Type', 'application/json');
        }
        if(!$request->has('uId')){
            $statusCode = config('StatusCodes.MISSING_PARAMETER');
            return response(array('code'=>'1',"status" => "failure",'statusCode'=>$statusCode,'message'=>'Unique ID is missing'))->header('Content-Type', 'application/json');
        }
        return feeds::getFeed($request->all());
    }

    public function addFeeds(Request $request)
    {
        return feeds::addFeed($request->all());
    }
	
	 public function viewFeed(Request $request)
    {
        return admin::viewFeed($request->all());
    }

    public function saveFeed(Request $request)
    {
        return feeds::saveFeed($request->all());
    }

    public function saveEditFeed(Request $request)
    {
        return feeds::saveEditFeed($request->all());
    }

    public function deleteFeed(Request $request)
    {
        return feeds::deleteFeed($request->all());
    }

    public function setFeed(Request $request)
    {
        return admin::setFeed($request->all());
    }

    public function saveSetFeed(Request $request)
    {
        return admin::saveSetFeed($request->all());
    }

	 public function apply(Request $request)
    {
        return feeds::apply($request->all());
    }

    public function comments(Request $request)
    {
        return admin::comments($request->all());
    }

    public function accept(Request $request)
    {
        return admin::accept($request->all());
    }
    public function viewSurvey(){
        
        return View::make('survey');
        
    }
    public function addSurvey(Request $request){

        $result = Survey::addSurvey($request->all());
        if($result){
            $request->session()->flash('message', 'Successfully Sent!');
            return Redirect::to("survey");
        }
        $request->session()->flash('message', '');
        return Redirect::to("survey");
    }
}
