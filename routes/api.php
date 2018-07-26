<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('api_branches','BranchController@index');

Route::get('api_downloads','DownloadController@index');

Route::get('api_faqs','FaqController@index');

Route::get('api_news','NewsitemController@index');

Route::get('api_unit_prices','UnitPriceController@showPrices');

Route::get('api_send_comment','ResponseController@sendComment');
