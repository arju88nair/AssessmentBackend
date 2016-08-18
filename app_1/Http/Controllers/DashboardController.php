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
}
