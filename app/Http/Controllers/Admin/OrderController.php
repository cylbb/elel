<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    public function index(){

    }

    /**
     * 订单每日统计量
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function day(Request $request){
        $query = Order::orderBy('id');
        //得到所有店铺数据
        $shops = Shop::all();
        $shId = $shops->pluck('id')->toArray();
        //接收参数
        $shopId = $request->input('shop_id');
        $start = $request->input('start');
        $end = $request->input('end');
        if ($shopId !== null) {
            $query->where('shop_id', $shopId);
        }
        if ($start != null) {
            $query->whereDate('created_at', '>=', $start);
        }
        if ($end != null) {
            $query->whereDate('created_at', '<=', $end);
        }
        $orders = $query->whereIn('shop_id', $shId)
            ->select(DB::raw('DATE_FORMAT(created_at,"%Y-%m-%d") as day,
            SUM(order_price) as money,COUNT(*) as count'))->groupBy('day')
            ->orderBy('day', 'desc')->limit(10)->get();
        //显示视图并传递数据
        return view('admin.order.day',compact('orders','shops'));
    }

    /**
     * 订单每月总统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function month(Request $request){
        $query = Order::orderBy('id');
        //得到所有店铺数据
        $shops = Shop::all();
        $shId = $shops->pluck('id')->toArray();
        //接收参数
        $shopId = $request->input('shop_id');
        if ($shopId !== null) {
            $query->where('shop_id', $shopId);
        }
        $orders = $query->whereIn('shop_id', $shId)
            ->select(DB::raw('DATE_FORMAT(created_at,"%Y-%m") as day,
            SUM(order_price) as money,COUNT(*) as count'))->groupBy('day')
            ->orderBy('day', 'desc')->limit(12)->get();
        return view('admin.order.month',compact('orders','shops'));
    }

    /**
     * 订单总计
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function total(Request $request){
        $query = Order::orderBy('id');
        //得到所有店铺数据
        $shops = Shop::all();
        $shId = $shops->pluck('id')->toArray();
        //接收参数
        $shopId = $request->input('shop_id');
        if ($shopId !== null) {
            $query->where('shop_id', $shopId);
        }
        $query = $query->whereIn('shop_id', $shId)
            ->select(DB::raw('SUM(order_price) as money,COUNT(*) as count'))->first();
        //显示视图并传递数据
        return view('admin.order.total',compact('query','shops'));
    }

    /**
     * 菜品每日统计
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goodDay(Request $request){
        $query = Order::orderBy('id');
        //得到所有店铺数据
        $shops = Shop::all();
        //接收参数
        $shopId = $request->input('shop_id');
        $start = $request->input('start');
        $end = $request->input('end');
        if ($shopId !== null) {
            $query->where('shop_id', $shopId);
        }
        if ($start != null) {
            $query->whereDate('created_at', '>=', $start);
        }
        if ($end != null) {
            $query->whereDate('created_at', '<=', $end);
        }
        $orderId=$query->pluck('id')->toArray();
        $goods = OrderGood::whereIn('order_id', $orderId)
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') AS date,goods_name,sum(amount) as nums"))->groupBy('goods_name','date')
            ->orderBy('date', 'desc')->limit(10)->get();
       return view('admin.order.goodDay',compact('goods','shops'));
    }

    /**
     * 菜品每月统计
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function goodMonth(Request $request){
       $query = Order::orderBy('id');
       //得到所有店铺数据
       $shops = Shop::all();
       //接收参数
       $shopId = $request->input('shop_id');
       if ($shopId !== null) {
           $query->where('shop_id', $shopId);
       }
       $orderId=$query->pluck('id')->toArray();
       $goods = OrderGood::whereIn('order_id', $orderId)
           ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') AS date,goods_name,sum(amount) as nums"))->groupBy('goods_name','date')
           ->orderBy('date', 'desc')->limit(10)->get();
       return view('admin.order.goodMonth',compact('goods','shops'));
   }

    /**
     * 菜品统计量
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function goodTotal(Request $request){
       $query = Order::orderBy('id');
       //得到所有店铺数据
       $shops = Shop::all();
       //接收参数
       $shopId = $request->input('shop_id');
       if ($shopId !== null) {
           $query->where('shop_id', $shopId);
       }
       $orderId=$query->pluck('id')->toArray();
       $goods = OrderGood::whereIn('order_id', $orderId)
           ->select(DB::raw('SUM(amount) as nums,goods_name'))
           ->groupBy('goods_name')->get();
       return view('admin.order.goodTotal',compact('goods','shops'));
   }
}
