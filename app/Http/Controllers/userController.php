<?php

namespace App\Http\Controllers;

use App\Model\coupon;
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


    public function index(Request $request)
    {

        return addUser::insert($request->all());

    }


    public function coupon(Request $request)
    {

        return coupon::insert($request->all());
    }


    public function getC(Request $request)
    {
        $get = coupon::getCoupon($request->all());
        return $get;

    }

    public function getUser(Request $request)
    {
        return addUser::getUser($request->all());
    }

    public function addUser(Request $request)
    {


        return addUser::userCheck($request->all());
    }

    public function test(Request $request)
    {
        return addUser::test($request->all());
    }

    public function testUser(Request $request)
    {

        $test= Tests::getTestarray($request->all());
        $model= addUser::getUser($request->all());
        return $test;


    }
    public function addAnswers(Request $request){
        return addUser::addanswers($request->all());
    }

    public function login(Request $request){
        return View::make('login');
    }


    public function admin(Request $request){
        return admin::index($request->all());
    }

    public function getdetails(Request $request){
        return admin::login($request->all());
    }

    public function testDetails(Request $request){
        return admin::testDetails($request->all());
    }


    public function invite(Request $request)
    {

        if(!$request->has('sessionHandle'))
        {
            return array("code" => "1", "status" => "error", "message" => "Session handle can't be found");
        }
        if(!$request->has('invitees'))
        {
            return array("code" => "1", "status" => "error", "message" => "Invitees array can't be found");
        }
        if(!$request->has('testId'))
        {
            return array("code" => "1", "status" => "error", "message" => "Test Id can't be found");
        }

        return invite::invite($request->all());
    }



    public  function delete(Request $request)
    {
        return admin::deleteTest($request->all());
    }


    public function dashboard(Request $request){
        return admin::dashboard($request->all());
    }

    public function edit(Request $request)
    {
        return admin::edit($request->all());
    }

        public function saveEdit(Request $request)
    {
        return questions::saveEdit($request->all());
    }


    public function addTest(Request $request)
    {
        return View::make('addTest');
    }

    public function saveTest(Request $request)
    {
        return questions::addTest($request->all());

    }


    public function assistanceRequest(Request $request)
    {
        return assistance::requestAssistance($request ->all());
    }

    public function suggestInvitees(Request $request)
    {
        return invite::getInvitees($request ->all());
    }


    public function viewUsers(Request $request)
    {
        return admin::viewUsers($request->all());
    }



}
