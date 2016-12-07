<?php

namespace App\Http\Controllers;

use App\Model\admin;
use App\Model\feeds;
use Illuminate\Http\Request;
use App\Http\Requests;

class DashboardController extends Controller
{
    //


    public function getFeeds(Request $request)
    {
        return feeds::getFeed($request->all());
    }


    public function addFeeds(Request $request)
    {
        return feeds::addFeed($request->all());
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

    public function test(Request $request)
    {
		
        return admin::test($request->all());
    }


    public function notification(Request $request)
    {
        return admin::notification($request->all());
    }
	
	
	public function chartpdf(Request $request)
	{
		return admin::chartPdf($request->all());
	}
	
	
	
	public function testView(Request $request)
	{
		return admin::testView($request->all());
	}


    public function viewFeed(Request $request)
    {
        return admin::viewFeed($request->all());
    }


    public function setFeed(Request $request)
    {
        return admin::setFeed($request->all());
    }
    public function testFeed(Request $request)
    {
        return admin::testFeed($request->all());
    }

    public function saveSetFeed(Request $request)
    {
        return admin::saveSetFeed($request->all());
    }

    public function accept(Request $request)
    {
        return admin::accept($request->all());
    }
	
	 public function apply(Request $request)
    {
        return feeds::apply($request->all());
    }

    public function comments(Request $request)
    {
        return admin::comments($request->all());
    }

}
