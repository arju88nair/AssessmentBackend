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


/*API Routes*/

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

Route::post('invite','userController@invite');

Route::post('requestReport','FileController@requestReport');

Route::post('requestAssistance','userController@assistanceRequest');

Route::post('suggestInvitees','userController@suggestInvitees');

Route::post('getFeeds','DashboardController@getFeeds');

Route::post('addFeeds','DashboardController@addFeeds');

Route::post('enterVoucher','userController@enterVoucher');







//   Admin routes

Route::get('loginAdmin','userController@login');

Route::post('addAdmin','userController@admin');

Route::post('dashboard','userController@getdetails');

Route::get('dashboardAction','userController@dashboard');

Route::get('testDetails','userController@testDetails');

Route::get('delete','userController@delete');

Route::get('edit','userController@edit');

<<<<<<< HEAD
Route::get('userDetails','userController@userDetails');

=======
>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432
Route::get('newEdit','userController@newEdit');

Route::get('addTest','userController@addTest');

Route::post('saveEdit','userController@saveEdit');

Route::get('addEdit','userController@addEdit');

Route::post('saveNewEdit','userController@saveNewEdit');

Route::post('saveTest','userController@saveTest');

Route::get('viewUsers','userController@viewUsers');

Route::get('userTestDetails','userController@userTestDetails');

Route::get('addFeed','userController@addFeed');

Route::post('saveFeed','DashboardController@saveFeed');

Route::post('saveEditFeed','DashboardController@saveEditFeed');

Route::get('deleteFeed','DashboardController@deleteFeed');

<<<<<<< HEAD
Route::get('test','DashboardController@test');

Route::get('notification','DashboardController@notification');

Route::post('search','userController@search');

=======
Route::post('test','DashboardController@test');

Route::get('notification','DashboardController@notification');

>>>>>>> e6b01fa5eba2ee2c54f078308f37f51a5f282432










