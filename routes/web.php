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

//-------------------------------------------------------------------------------------------------
//APP
Route::get('admin/goods/index', function () {
    return view('App.admin.goods.index');
});
//Category商品分类
Route::get('/admin/log', 'App\admin\LogController@log');
Route::post('/admin/log_do', 'App\admin\LogController@log_do');
Route::group(['middleware' => ['log']], function () {
//添加
    Route::get('/admin/category/add', 'App\admin\CategoryController@add');
    Route::post('/admin/category/add_do', 'App\admin\CategoryController@add_do');
    Route::get('/admin/category/first', 'App\admin\CategoryController@first');
    Route::get('/admin/category/index', 'App\admin\CategoryController@index');
//goods商品
    Route::get('/admin/goods/add', 'App\admin\GoodsController@add');
    Route::get('/admin/goods/ajax_add', 'App\admin\GoodsController@ajax_add');
    Route::post('/admin/goods/add_do', 'App\admin\GoodsController@add_do');
    Route::get('/admin/goods/index', 'App\admin\GoodsController@index');
    Route::get('/admin/goods/product_add/{goods_id}', 'App\admin\GoodsController@product_add');//货品添加
    Route::post('/admin/goods/product_add_do', 'App\admin\GoodsController@product_add_do');//货品添加
    Route::get('/admin/product/index', 'App\admin\GoodsController@product_index');//货品展示
    Route::get('/admin/goods/delete', 'App\admin\GoodsController@delete');//商品删除
    Route::post('/admin/goods/update', 'App\admin\GoodsController@update');//商品修改


//type类型
    Route::get('/admin/type/add', 'App\admin\TypeController@add');
    Route::post('/admin/type/add_do', 'App\admin\TypeController@add_do');
    Route::get('/admin/type/index', 'App\admin\TypeController@index');

//attribute属性
    Route::get('/admin/attribute/index', 'App\admin\AttributeController@index');
    Route::get('/admin/attribute/index_do', 'App\admin\AttributeController@index_do');
    Route::get('/admin/attribute/add', 'App\admin\AttributeController@add');
    Route::post('/admin/attribute/add_do', 'App\admin\AttributeController@add_do');
    Route::get('/admin/attribute/delete', 'App\admin\AttributeController@delete');
});
//---------------------------------前台----------------------------
Route::group(['middleware' => ['header']], function () {
    //
    Route::resource('index/goods', 'App\index\GoodsController');
    Route::get('index/details_goods', 'App\index\GoodsController@details_goods');
    Route::post('index/log_do', 'App\index\LogController@log_do');//登录
    Route::post('index/user_info', 'App\index\LogController@user_info');//
    Route::get('index/goods_index', 'App\index\GoodsController@goods_index');//商品列表
    Route::resource('index/category', 'App\index\CategoryController');

});
Route::group(['middleware' => ['header','index_log']], function () {
    //
    Route::get('index/addCate', 'App\index\GoodsController@addCate');//商品列表
    Route::get('index/cart_index', 'App\index\GoodsController@cart_index');//购物车展示
    Route::post('index/update_cart', 'App\index\GoodsController@update_cart');//购物车展示
    Route::get('index/delete_cart', 'App\index\GoodsController@delete_cart');//购物车展示

});

//-----------------------周考三测试----------------------------------------------------------------
Route::post('weather/login', 'ceshi\api\zhoukao\WeatherController@login');//登录
Route::get('weather/user_info', 'ceshi\api\zhoukao\WeatherController@user_info');//登录
Route::get('weather/unset_token', 'ceshi\api\zhoukao\WeatherController@unset_token');//登录

Route::get('weather/log', function () {
    return view('ceshi.api.zoukao.weather.log');
});
Route::get('weather/index', function () {
    return view('ceshi.api.zoukao.weather.index');
});
