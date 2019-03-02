<?php

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

Route::group(['middleware' => 'cors'], function () {
    // 動画操作
    Route::get('movie', 'Movie\IndexController@index');
    Route::get('movie/{id}', 'Movie\IndexController@show');
    Route::post('movie', 'Movie\IndexController@store');
    Route::put('movie', 'Movie\IndexController@update');
    Route::delete('movie', 'Movie\IndexController@destroy');

    // 集計
    Route::get('popular', 'Movie\RankingController@popular');
});
