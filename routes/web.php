<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Website

Route::get('/','HomeController@index');

Route::get('/about-us','HomeController@about_us');
Route::get('/about-us/{pages}','HomeController@about_us');

Route::get('/branches','HomeController@branches');
Route::get('/branches/{pages}','HomeController@branches');

Route::get('/food-beverages/{cat}','HomeController@food_beverages');
Route::get('/food-beverages/{cat}/{sub}','HomeController@food_beverages');

Route::get('food-beverages', function () {
    return redirect('/food-beverages/healthy-breakfast');
});

Route::get('/promos','HomeController@promos');
Route::get('/promos/{pages}','HomeController@promos');

Route::get('/events','HomeController@events');
Route::get('/events/{pages}','HomeController@events');

Route::get('/careers','HomeController@careers');

Route::get('/inquiry-comments','HomeController@inquiry_comments');

Route::get('/photos','HomeController@photos');
Route::get('/photos/{pages}','HomeController@photos');

Route::get('/search','HomeController@search');

Route::post('/send-mail','HomeController@send_mail');

Route::get('/login','HomeController@login');

Route::post('/login','LoginController@login');
Route::get('/logout','LoginController@logout');

//CMS
Route::group(['prefix' => '/cms'],function(){
	Route::get('/account-setting','CmsController@account_setting');

	Route::get('/user-manager','CmsController@user_manager');
	Route::get('/user-manager/{type}','CmsController@user_manager');
	Route::get('/user-manager/{type}/{id}','CmsController@user_manager');

	Route::get('/page-manager','CmsController@page_manager');
	Route::get('/page-manager/{type}','CmsController@page_manager');
	Route::get('/page-manager/{type}/{id}','CmsController@page_manager');

	Route::group(['prefix' => '/maintenance'],function(){
		Route::get('/homepage-banner','CmsController@homepage_banner');
		Route::get('/homepage-banner/{type}','CmsController@homepage_banner');
		Route::get('/homepage-banner/{type}/{id}','CmsController@homepage_banner');

		Route::get('/about-us','CmsController@about_us');
		Route::get('/about-us/{type}','CmsController@about_us');
		Route::get('/about-us/{type}/{id}','CmsController@about_us');

		Route::get('/food-beverages','CmsController@mfood_beverages');
		Route::get('/food-beverages/{type}','CmsController@mfood_beverages');
		Route::get('/food-beverages/{type}/{id}','CmsController@mfood_beverages');

		Route::get('/promos','CmsController@promos');
		Route::get('/promos/{type}','CmsController@promos');
		Route::get('/promos/{type}/{id}','CmsController@promos');

		Route::get('/events','CmsController@events');
		Route::get('/events/{type}','CmsController@events');
		Route::get('/events/{type}/{id}','CmsController@events');

		Route::get('/careers','CmsController@careers');
		Route::get('/careers/{type}','CmsController@careers');
		Route::get('/careers/{type}/{id}','CmsController@careers');

		Route::get('/photos','CmsController@mphotos');
		Route::get('/photos/{type}','CmsController@mphotos');
		Route::get('/photos/{type}/{id}','CmsController@mphotos');

		// Route::get('/rooms','CmsController@rooms');
		// Route::get('/rooms/{type}','CmsController@rooms');
		// Route::get('/rooms/{type}/{id}','CmsController@rooms');
	});

	Route::group(['prefix' => '/category'],function(){
		Route::get('/food-beverages','CmsController@cfood_beverages');
		Route::get('/food-beverages/{type}','CmsController@cfood_beverages');
		Route::get('/food-beverages/{type}/{id}','CmsController@cfood_beverages');

		Route::get('/photos','CmsController@cphotos');
		Route::get('/photos/{type}','CmsController@cphotos');
		Route::get('/photos/{type}/{id}','CmsController@cphotos');
	});

	Route::get('/branch-manager','CmsController@branch_manager');
	Route::get('/branch-manager/{type}','CmsController@branch_manager');
	Route::get('/branch-manager/{type}/{id}','CmsController@branch_manager');

	Route::get('/social-media-management','CmsController@social_media_management');
	Route::get('/social-media-management/{type}','CmsController@social_media_management');
	Route::get('/social-media-management/{type}/{id}','CmsController@social_media_management');

	Route::get('/database-management','CmsController@database_management');

	Route::get('/activity-logs','CmsController@activity_logs');

	Route::get('/settings','CmsController@settings');
});

Route::group(['prefix' => '/export'],function(){
	Route::get('/{page}','CmsController@export');
	Route::post('/{page}','CmsController@export');

	Route::get('/{page}/{type}','CmsController@export');
	Route::post('/{page}/{type}','CmsController@export');
});

Route::group(['prefix' => '/api'],function(){
	Route::get('/{type}','CmsController@api');
	Route::post('/{type}','CmsController@api');

	Route::get('/{type}/{requests}','CmsController@api');
	Route::post('/{type}/{requests}','CmsController@api');
});