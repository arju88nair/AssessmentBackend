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

Route::post('login','userController@addUser');

Route::post('getFeeds','DashboardController@getFeeds');

Route::post('feedCount','userController@feedCount');

Route::post('like','userController@like');

Route::post('unlike','userController@unlike');

Route::post('addCategories','userController@addCategories');

/*Route::post('userCount','userController@userCount');*/

Route::post('getFeedIds','userController@getFeedIds');

Route::post('postComments','userController@comments');


//   Admin routes
Route::get('/', 'userController@redirect');

Route::get('loginAdmin','userController@login');

Route::post('addAdmin','userController@admin');

Route::post('dashboard','userController@getdetails');

Route::get('dashboardAction','userController@dashboard');

Route::get('addFeed','userController@addFeed');

Route::post('saveFeed','DashboardController@saveFeed');

Route::post('saveEditFeed','DashboardController@saveEditFeed');

Route::get('deleteFeed','DashboardController@deleteFeed');

Route::get('setFeed','DashboardController@setFeed');

Route::post('saveSetFeed','DashboardController@saveSetFeed');

Route::get('apply','DashboardController@apply');

Route::get('comments','DashboardController@comments');

Route::post('viewFeed','DashboardController@viewFeed');

Route::post('accept','DashboardController@accept');

Route::get('survey','DashboardController@viewSurvey');

Route::post('addSurvey','DashboardController@addSurvey');