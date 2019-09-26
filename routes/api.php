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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// foods
Route::post('/foods','FoodsController@create');
Route::get('/foods','FoodsController@index');
Route::put('/foodsupdate/{idfoods}','FoodsController@update');
Route::delete('/foodsdelete/{idfoods}','FoodsController@delete');

// Sellings
Route::get('/sellings','SellingsController@index');
Route::post('/sellings','SellingsController@create');


