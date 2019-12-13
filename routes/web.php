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


Route::get('/', 'AppController@showPage')->name('home');//display the home page
Route::get('/ops', function () {    return view('backend/login');})->name('login'); //..displays backend login page
//File downloads
Route::get('/downloads/{file}', 'AppController@downloadFile');//download an item
Route::get('/viewfile/{file}', 'AppController@viewFile');//view a file in browser
Route::get('logout', 'UserController@logoutUser')->name('logout'); //..logout user
Route::get('/users', 'UserController@index')->name('show_users'); //..display users page
Route::get('/create_user', 'UserController@createAdmin')->name('create_user'); //..display create administrator page
Route::post('create_administrator', 'UserController@postCreateUser')->name('create_u'); //..submit post data to create an administrator
Route::get('/usergroups', 'UserController@showUserGroups')->name('show_usergroups')->middleware('auth'); //..display usergroups page
Route::get('/module/{generic}', 'AppController@showPage')->middleware('auth');//display a module::about,services
Route::post('/module/dashboard', 'UserController@postLoginUser')->name('login_u'); //..process login
Route::post('site_update', 'AppController@updateSite')->name('update_site')->middleware('auth'); //process site info
Route::post('delete', 'AppController@destroy')->name('delete_item')->middleware('auth');
//site pages & content
Route::post('pension_calculator', 'AppController@pensionCalculator')->name('pension_calc'); //pension calculator
Route::get('/unitprice/range','AppController@fetchRangeOfPrices')->name('unitprice_range');
Route::get('/slides/range','SlideController@index')->name('top4_slides');
Route::get('/homedata','AppController@fetchHomeData')->name('home_data');
Route::get('/pagedata','AppController@fetchPageData');
Route::get('/pagedata_noimages','AppController@fetchPageDataNoImages');
Route::get('/fetchLatestPrices','AppController@fetchLatestPricesById')->name('home_data');
//generic page requests
Route::get('page/{generic}', 'AppController@showPage');//old routes
Route::get('/page/{service}/{generic}', 'AppController@showPage');//old routes
Route::get('/{generic}', 'AppController@showPage');//display a page
Route::get('/{service}/{generic}', 'AppController@showPage');//display news

Route::post('web-register', 'AppController@processRegister');

Route::post('web-careers', 'AppController@processCareers');
//client testimonials
Route::post('web-feedback', 'AppController@processClientTestimonial');

//PROCESSING
Route::post('process_register', 'AppController@processRegister')->name('process_register'); //process register item
//States
Route::post('process_states', 'AppController@processStates')->name('process_states'); //process state items
//Email
Route::post('register', 'AppController@processRegMail')->name('process_reg_mail'); //process state items
//Modules
Route::post('processm', 'AppController@processModule')->name('processm'); //process about items
//Roles
Route::post('process_usergroup', 'UserController@processUserGroups')->name('process_role')->middleware('auth'); //..create/edit usergroups
//Feedback
Route::post('process_feedback', 'AppController@processContact')->name('process_feedback'); //process feedback items

Route::post('delete_feedback', 'AppController@destroy')->name('delete_feedback');