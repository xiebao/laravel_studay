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


// 获取服务器时间戳
Route::get('/server/time', 'AuthController@getTime');

Route::group(['middleware' => 'api'], function () {
    // 获取技术与产品数据
    Route::get('tech', 'TechController@index');
    //Route::get('dynamic', 'DynamicController@index');
    // 获取动态与新闻的数据
    Route::get('news', 'NewsController@index');
    // 新增用户留言
    Route::post('message/create', 'MessageController@create');

    // 用户登录
    Route::post('/dz/login', 'DzController@login');
});



Route::group(['middleware' => 'auth'], function () {
    // 技术与产品的增删改查
    Route::get('tech/{id}', 'TechController@show')->where('id', '\d+');
    Route::post('tech/create', 'TechController@create');
    Route::post('tech/{id}', 'TechController@store')->where('id', '\d+');
    Route::delete('tech/{id}', 'TechController@delete')->where('id', '\d+');

    // 动态的增删改查
    /*Route::get('dynamic/{id}', 'DynamicController@show')->where('id', '\d+');
    Route::post('dynamic/create', 'DynamicController@create');
    Route::post('dynamic/{id}', 'DynamicController@store')->where('id', '\d+');
    Route::delete('dynamic/{id}', 'DynamicController@delete')->where('id', '\d+');*/

    // 新闻的增删改查
    Route::get('news/{id}', 'NewsController@show')->where('id', '\d+');
    Route::post('news/create', 'NewsController@create');
    Route::post('news/{id}', 'NewsController@store')->where('id', '\d+');
    Route::delete('news/{id}', 'NewsController@delete')->where('id', '\d+');

    // 用户留言的增删查
    Route::get('message', 'MessageController@index');
    Route::get('message/{id}', 'MessageController@show')->where('id', '\d+');
    Route::delete('message/{id}', 'MessageController@delete')->where('id', '\d+');

    // 用户退出
    Route::post('/auth/logout', 'AuthController@logout');
});
