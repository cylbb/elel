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

Route::namespace('Api')->group(function () {
    // 在 "App\Http\Controllers\Api" 命名空间下的控制器
    //店铺列表
    Route::get("shop/list","ShopController@list");
    Route::get("shop/index","ShopController@index");

    //会员管理
    Route::any("member/reg","MemberController@reg");
    Route::any("member/sms","MemberController@sms");
    Route::any("member/login","MemberController@login");
    Route::any("member/update","MemberController@update");
    Route::any("member/edit","MemberController@edit");
    Route::any("member/detail","MemberController@detail");

    //地址管理
    Route::any("addresse/add","AddressController@add");
    Route::any("addresse/edit","AddressController@edit");
    Route::any("addresse/index","AddressController@index");
    Route::any("addresse/update","AddressController@update");

    //购物车列表
    Route::any("cart/index","CartController@index");
    Route::any("cart/add","CartController@add");

    //订单列表
    Route::post("order/add","OrderController@add");
    Route::post("order/pay","OrderController@pay");
    Route::get("order/index","OrderController@index");
    Route::get("order/detail","OrderController@detail");
});


