<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\questions;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

class TestController extends Controller
{
    //


    public function index(Request $request)
    {

        return questions::insert($request->all());

    }

    public function dashboard(Request $request)
    {
        return questions::getDashboard($request->all());
    }

    public function getTests(Request $request)
    {
        return questions::getTests($request->all());
    }


    public function addTests(Request $request)
    {
        return questions::addTests($request->all());
    }

    public function deleteTests(Request $request){
        return questions::deleteTest($request->all());
    }

}
