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

Route::get('/location', 'Api\LocationController');
Route::get('/forecast', 'Api\ForecastController');
Route::post('/subscribe', 'Api\SubscriberController@subscribe');
Route::post('/login', 'Api\SubscriberController@login');
Route::post('/logout', 'Api\SubscriberController@logout');
Route::put('/{user}/location', 'Api\SubscriberController@setDefaultLocation');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
