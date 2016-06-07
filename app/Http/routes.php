<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::post('user', 'userController@index');
Route::post('coupon','userController@coupon');
Route::get('getcoupon','userController@getC');
Route::get('getuser','userController@getuser');

Route::post('login','userController@addUser');

Route::post('getTests','TestController@dashboard');

Route::post('getTestContents','TestController@getTests');

Route::post('addTests','TestController@addTests');

Route::post('submitUserResponses','userController@addAnswers');




Route::get('upload', 'FileController@index');


Route::post('apply/multiple_upload','FileController@upload_file');

Route::post('deleteTest','TestController@deleteTests');

Route::post('downloadFile','FileController@download');

Route::get('loginAdmin','userController@login');

Route::post('addAdmin','userController@admin');

Route::post('dashbaord','userController@getdetails');

Route::get('testDetails','userController@testDetails');
