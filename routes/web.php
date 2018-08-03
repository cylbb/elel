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
//平台管理
Route::domain('admin.eleb.com')->namespace('Admin')->group(function () {
    //店铺分类
    Route::get('shop_category/index',"ShopCategoryController@index")->name('shop_category.index');
    Route::any('shop_category/add',"ShopCategoryController@add")->name('shop_category.add');
    Route::any('shop_category/edit/{id}',"ShopCategoryController@edit")->name('shop_category.edit');
    Route::get('shop_category/del/{id}',"ShopCategoryController@del")->name('shop_category.del');
    //商家信息
    Route::get('shop/index',"ShopController@index")->name('shop.index');
    Route::any('shop/add',"ShopController@add")->name('shop.add');
    Route::any('shop/edit/{id}',"ShopController@edit")->name('shop.edit');
    Route::get('shop/del/{id}',"ShopController@del")->name('shop.del');
    Route::any('shop/check/{id}',"ShopController@check")->name('shop.check');
    //管理员账号管理
    Route::get('admin/index',"AdminController@index")->name('admin.index');
    Route::any('admin/reg',"AdminController@reg")->name('admin.reg');
    Route::any('admin/edit/{id}',"AdminController@edit")->name('admin.edit');
    Route::get('admin/del/{id}',"AdminController@del")->name('admin.del');
    Route::any('admin/login',"AdminController@login")->name('admin.login');
    Route::any('admin/logout',"AdminController@logout")->name('admin.logout');
    Route::any('admin/update',"AdminController@update")->name('admin.update');
    //活动管理
    Route::get('activity/index',"ActivityController@index")->name('activitys.index');
    Route::any('activity/add',"ActivityController@add")->name('activity.add');
    Route::any('activity/edit/{id}',"ActivityController@edit")->name('activity.edit');
    Route::get('activity/del/{id}',"ActivityController@del")->name('activity.del');
    Route::get('activity/unStart',"ActivityController@unStart")->name('activity.unStart');
    Route::get('activity/going',"ActivityController@going")->name('activity.going');
    Route::get('activity/over',"ActivityController@over")->name('activity.over');
    //商家订单
    Route::any('order/index',"OrderController@index")->name('orders.index');
    Route::any('order/day',"OrderController@day")->name('orders.day');
    Route::any('order/month',"OrderController@month")->name('orders.month');
    Route::any('order/total',"OrderController@total")->name('orders.total');
    Route::any('order/goodDay',"OrderController@goodDay")->name('orders.goodDay');
    Route::any('order/goodMonth',"OrderController@goodMonth")->name('orders.goodMonth');
    Route::any('order/goodTotal',"OrderController@goodTotal")->name('orders.goodTotal');
    //会员管理
    Route::any('member/index',"MemberController@index")->name('member.index');
    Route::any('member/info/{id}',"MemberController@info")->name('member.info');
    Route::any('member/check/{id}',"MemberController@check")->name('member.check');

    //权限管理
    Route::get('per/index',"PerController@index")->name('per.index');
    Route::any('per/add',"PerController@add")->name('per.add');
    Route::get('per/del/{id}',"PerController@del")->name('per.del');

    //给角色添加权限
    Route::get('role/index',"RoleController@index")->name('role.index');
    Route::any('role/add',"RoleController@add")->name('role.add');
    Route::any('role/edit/{id}',"RoleController@edit")->name('role.edit');
    Route::any('role/del/{id}',"RoleController@del")->name('role.del');
});
//商家
Route::domain('shop.eleb.com')->namespace('Shop')->group(function () {
    //店铺分类
    Route::get('user/index',"UserController@index")->name('user.index');
    Route::any('user/reg',"UserController@reg")->name('user.reg');
    Route::any('user/edit/{id}',"UserController@edit")->name('user.edit');
    Route::get('user/del/{id}',"UserController@del")->name('user.del');
    Route::any('user/login',"UserController@login")->name('user.login');
    Route::any('user/logout',"UserController@logout")->name('user.logout');
    Route::any('user/update',"UserController@update")->name('user.update');
    //菜品分类
    Route::get('menu_cate/index',"MenuCateController@index")->name('cate.index');
    Route::any('menu_cate/add',"MenuCateController@add")->name('cate.add');
    Route::any('menu_cate/edit/{id}',"MenuCateController@edit")->name('cate.edit');
    Route::get('menu_cate/del/{id}',"MenuCateController@del")->name('cate.del');
    //菜品列表
    Route::get('menu/index',"MenuController@index")->name('menu.index');
    Route::any('menu/add',"MenuController@add")->name('menu.add');
    Route::any('menu/edit/{id}',"MenuController@edit")->name('menu.edit');
    Route::get('menu/del/{id}',"MenuController@del")->name('menu.del');
    //活动列表
    Route::get('activity/index',"ActivityController@index")->name('activity.index');
    Route::any('activity/show/{id}',"ActivityController@show")->name('activity.show');
    //订单统计
    Route::get('order/index',"OrderController@index")->name('order.index');
    Route::any('order/show/{id}',"OrderController@show")->name('order.show');
    Route::any('order/cancel/{id}',"OrderController@cancel")->name('order.cancel');
    Route::any('order/send/{id}',"OrderController@send")->name('order.send');
    Route::any('order/day',"OrderController@day")->name('order.day');
    Route::any('order/month',"OrderController@month")->name('order.month');
    Route::any('order/total',"OrderController@total")->name('order.total');
    Route::any('order/goodDay',"OrderController@goodDay")->name('order.goodDay');
    Route::any('order/goodMonth',"OrderController@goodMonth")->name('order.goodMonth');
//    Route::any('order/sum',"OrderController@sum")->name('order.sum');

});
