<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    /**
     * 订单列表
     * @param Request $request
     */
    public function index(Request $request){
       //得到用户的id
        $orders=Order::where('user_id',$request->input('user_id'))->get();
        foreach ($orders as $order){
            $data['id']=$order->id;
            $data['order_code']=$order->sn;
            $data['order_birth_time']=(string)$order->created_at;
            $data['order_status']=$order->order_status;
            $data['shop_id']=$order->shop_id;
            $data['shop_name']=$order->shop->shop_name;
            $data['shop_img']="/uploads/".$order->shop->shop_logo;
            $data['order_price']=$order->order_price;
            $data['order_address']=$order->province . $order->city . $order->county . $order->address;
            $data['goods_list']=$order->goods;
            $datas[]=$data;
        }
        return $datas;
    }

    /**
     * 添加商品
     * @param Request $request
     * @return array
     */
    public function add(Request $request){
       //找出地址id
        $address=Address::find($request->post('address_id'));
        //判断地址
        if($address==null){
            return [
                "status" => "false",
                "message" => "地址选择不正确"
            ];
        }
        //找到用户id
        $data['user_id']=$request->post('user_id');
        //店铺id
        $carts=Cart::where('user_id',$request->input('user_id'))->get();
        //找到购物车的第一条id
        $shopId=Menu::find($carts[0]->goods_id)->shop_id;
        $data['shop_id']=$shopId;
        //订单号生成
        $data['sn']=date('ymdHis').rand(1000,9999);
        //地址
        $data['province']=$address->provence;
        $data['city']=$address->city;
        $data['county']=$address->area;
        $data['address']=$address->detail_address;
        $data['tel']=$address->tel;
        $data['name']=$address->name;
        //计算总价
        $totalCost=0;
        foreach ($carts as $k=>$v){
            $good=Menu::where('id',$v->goods_id)->first();
            $totalCost += $v->amount * $good->goods_price;
        }
        $data['order_price']= $totalCost;
        //判断状态
        $data['status']=0;
        //开启事务
        DB::beginTransaction();
        try{
            //生成订单
            $order=Order::create($data);
            //添加订单商品
//        dd($carts);
            foreach ($carts as $k1=>$v1){
                //找到所属商品编号
                $good=Menu::find($v1->goods_id);
                //插入数据
                $dataGoods['order_id']=$order->id;
                $dataGoods['goods_id']=$v1->goods_id;
                $dataGoods['amount']=$v1->amount;
                $dataGoods['goods_name']=$good->goods_name;
                $dataGoods['goods_img']="/uploads/".$good->goods_logo;
                $dataGoods['goods_price']=$good->goods_price;
//            dd($good);
                //插入数据
                OrderGood::create($dataGoods);
            }
            //清空当前用户购物车
            Cart::where("user_id",$request->post('user_id'))->delete();
            //提交
            DB::commit();
        }catch (QueryException $exception){
            //回滚
            DB::rollBack();
            //返回数据
            return [
                "status" => "false",
                "message" => $exception->getMessage(),
            ];
        }
        //返回
        return [
            "status" => "true",
            "message" => "添加成功",
            "order_id" => $order->id
        ];
    }

    /**
     * 订单详情
     * @param Request $request
     */
    public function detail(Request $request){
      //找到id
        $order=Order::find($request->input('id'));
        $data['id']=$order->id;
        $data['order_code']=$order->sn;
        $data['order_birth_time']=(string)$order->created_at;
        $data['order_status']=$order->order_status;
        $data['shop_id']=$order->shop_id;
        $data['shop_name']=$order->shop->shop_name;
        $data['shop_img']="/uploads/".$order->shop->shop_logo;
        $data['order_price']=$order->order_price;
        $data['order_address']=$order->province . $order->city . $order->county . $order->address;
        $data['goods_list']=$order->goods;
        return $data;
    }

    /**
     * 支付
     * @param Request $request
     * @return array
     */
    public function pay(Request $request){
        //得到订单号
        $order=Order::find($request->post('id'));
        //得到用户
        $member=Member::where('id',$order->user_id)->first();
        //判断用户是否有钱
        if($order->order_price>$member->money){
            return [
                "status" => "false",
                "message" => "账户余额不够"
            ];
        }
        //扣钱
        $member->money=$member->money-$order->order_price;
        $member->save();
        //更改状态
        $order->status=1;
        $order->save();
        return [
            "status" => "true",
            "message" => "支付成功",
        ];
    }
}
