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
echo 11;
die;
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
