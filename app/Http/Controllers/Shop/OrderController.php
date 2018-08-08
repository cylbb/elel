<?php

namespace App\Http\Controllers\Shop;

use App\Models\Member;
use App\Models\Order;
use App\Models\OrderGood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    /**
     * 订单列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
        public function index(){
            $orders=Order::all();
            //显示视图
            return view('shop.order.index',compact('orders'));
        }

    /**
     * 订单详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
        public function show($id){
            $order=Order::findOrFail($id);
            $goods=OrderGood::where('order_id',$id)->get();

            //显示视图
            return view('shop.order.show',compact('order','goods'));
        }

    /**
     * 取消订单
     * @param Request $request
     * @param $id
     */
        public function cancel(Request $request,$id){
           $order=Order::find($id);
          $member=Member::find($order->user_id);
           if($order->status===-1 || $order->status===2 ||$order->status===3){
              $request->session()->flash("danger","订单不能被取消");
              return redirect()->back();
           }
           if($order->status==1){
             $member->money += $order->order_price;
               $request->session()->flash("success","订单取消成功");
           }
           $order->status=-1;
           $order->update();
            return redirect()->back();
        }

    /**
     * 订单发货
     * @param Request $request
     * @param $id
     */
        public function send(Request $request,$id){
              $order=Order::find($id);
              if($order->status!==1){
                  $request->session()->flash("danger","订单不能发货");
                  return redirect()->back();
              }
            $order->status=2;
            $order->update();
            return redirect()->back();
        }

    /**
     * 每日统计量
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
        public function day(Request $request){
            $shopId=Auth::user()->shop_id;
            $query=  Order::where("shop_id",$shopId)->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as day,SUM(order_price) AS money,count(*) AS count"))->groupBy("day")->orderBy("day",'desc')->limit(30);
            //接受参数
            $start=$request->input('start');
            $end=$request->input('end');
            if($start!==null){
                $query->whereDate("created_at", ">=", $start);
            }
            if($end!==null){
                $query->whereDate("created_at", "<=", $end);
            }
            //得到每日数量
            $orders=$query->get();
            //显示视图
            return view('shop.order.day',compact('orders'));
        }

    /**
     * 每月统计量
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
        public function month(Request $request){
            $shopId=Auth::user()->shop_id;
            $query=  Order::where("shop_id",$shopId)->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as day,SUM(order_price) AS money,count(*) AS count"))->groupBy("day")->orderBy("day",'desc')->limit(12);
            //得到所有数据
            $orders=$query->get();
            //显示视图
            return view('shop.order.month',compact('orders'));
        }

    /**
     * 订单总计
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
        public function total(){
            $shopId=Auth::user()->shop_id;
            $query=  Order::where("shop_id",$shopId)->Select(DB::raw("SUM(order_price) AS money,count(*) AS count"))->first();
            $orderId=Order::where('shop_id','=',Auth::user()->shop_id)->pluck('id')->toArray();
            $good=OrderGood::whereIn("order_id",$orderId)->Select(DB::raw("goods_name,sum(amount) as nums"))->first();
            return view('shop.order.total',compact('query',"good"));
        }

    /**
     * 菜品每日统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
        public function goodDay(Request $request){
            $orderId=Order::where('shop_id','=',Auth::user()->shop_id)->pluck('id')->toArray();
            $query=OrderGood::whereIn("order_id",$orderId)->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') AS date,goods_id,goods_name,sum(amount) as nums"))->groupBy("date","goods_id")->orderBy("date",'desc')->limit(30);
            //接受参数
            $start=$request->input('start');
            $end=$request->input('end');
            if($start!==null){
                $query->whereDate("created_at", ">=", $start);
            }
            if($end!==null){
                $query->whereDate("created_at", "<=", $end);
            }
            $goods=$query->get();
            return view('shop.order.goodDay',compact('goods'));
        }

    /**
     * 菜品每月统计
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
        public function goodMonth(){
            $orderId=Order::where('shop_id','=',Auth::user()->shop_id)->pluck('id')->toArray();
            $query=OrderGood::whereIn("order_id",$orderId)->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') AS date,goods_id,goods_name,sum(amount) as nums"))->groupBy("date","goods_id")->orderBy("date",'desc')->limit(12);
            $goods=$query->get();
            return view('shop.order.goodMonth',compact('goods'));
        }
        /*public function sum(){
            $orderId=Order::where('shop_id','=',Auth::user()->shop_id)->pluck('id')->toArray();
            $good=OrderGood::whereIn("order_id",$orderId)->Select(DB::raw("DATE_FORMAT AS goods_id,goods_name,sum(amount) as nums"))->first();
            return view('shop.order.sum',compact('good'));
        }*/
}
