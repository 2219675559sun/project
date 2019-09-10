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


Route::get('/', function () {
    return view('welcome');
});
//user 登录注册项目
Route::get('/user/log', 'UserController@log');
Route::post('/user/log_do', 'UserController@log_do');
Route::get('/user/login', 'UserController@login');
Route::post('/user/login_do', 'UserController@login_do');
Route::get('/user/code', 'UserController@code');
Route::get('/user/index', 'UserController@index');

//--------------------------------------------------------------------
//curl
Route::get('/curl/index', 'ceshi\CurlController@index');
Route::get('/curl/add', 'ceshi\CurlController@add');
Route::post('/curl/add_do', 'ceshi\CurlController@add_do');
Route::get('/curl/delete', 'ceshi\CurlController@delete');
Route::get('/curl/update', 'ceshi\CurlController@update');
Route::post('/curl/update_do', 'ceshi\CurlController@update_do');
//--------------------------------------------------------------------------------------
Route::get('/api/api', 'ceshi\ApiController@api');

Route::get('/api/user/add', function () {
    return view('ceshi.api.user.create');
});
Route::get('/api/user/index', function () {
    return view('ceshi.api.user.index');
});
Route::get('/api/user/update', function () {
    return view('ceshi.api.user.update');
});
//Route::any('/api/create', 'ceshi\ApiController@create');
Route::any('/api/index', 'ceshi\ApiController@index');
Route::any('/api/aes', 'ceshi\ApiController@aes');
Route::get('/api/adduser', 'ceshi\ApiController@adduser');
Route::get('/api/ceshi', 'ceshi\ApiController@ceshi');
//Route::get('/api/delete', 'ceshi\ApiController@delete');
//Route::get('/api/find', 'ceshi\ApiController@find');
//Route::any('/api/update', 'ceshi\ApiController@update');
Route::resource('api/user', 'ceshi\api\UserController');
Route::get('/api/1', function () {
    return view('ceshi.api.user.1');
});

//---------------------------------------------------------------------
//api_user 用户名注册
Route::resource('apiuser', 'ceshi\api\ApiUserController');

Route::get('userapi/create', function () {
    return view('ceshi.api.apiUser.add');
});
Route::get('userapi/index', function () {
    return view('ceshi.api.apiUser.index');
});
//-----------------------------------------------------------------------
//goodsapi
Route::resource('goodsapi', 'ceshi\api\GoodsApiController');

Route::get('goods_api/add', function () {
    return view('ceshi.api.zoukao.goodsApi.add');
});
Route::get('goods_api/index', function () {
    return view('ceshi.api.zoukao.goodsApi.index');
});
Route::get('goods_api/update', function () {
    return view('ceshi.api.zoukao.goodsApi.update');
});
