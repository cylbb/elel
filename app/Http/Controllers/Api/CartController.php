<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request){
        //得到当前用户的id
        $userId=$request->input('user_id');
//        dd($memberId);
        //得到购物车列表
          $carts=Cart::where('user_id',$userId)->get();
   //dd($carts);
        $totalCost = 0;
        foreach ($carts as $cart){
            $menu=Menu::where('id',$cart['goods_id'])->first();
            $cart['goods_name']=$menu['goods_name'];
            $cart['goods_img']="/uploads/".$menu['goods_logo'];
            $cart['goods_price']=$menu['goods_price'];
            $totalCost += $cart['amount']*$cart['goods_price'];

        }

        return [
            'goods_list'=>$carts,
            'totalCost'=>$totalCost
        ];
    }

    /**
     * 添加
     * @param Request $request
     * @return array
     */
    public function add(Request $request){
       Cart::where("user_id", $request->post('user_id'))->delete();
        //商品列表
       $goods=$request->post('goodsList');
//       dd($goods);
       //商品数量
       $counts=$request->post('goodsCount');
//       dd($count);
//        $data1=$request->all();
// dd($data1);
       foreach ($goods as $k=>$good){
          $data=[
              'user_id'=>$request->post('user_id'),
              'goods_id'=>$good,
              'amount'=>$counts[$k]
          ];
          //插入数据
//           dd($data);
           Cart::create($data);

       }
        return [
            'status' => "true",
            //获取错误信息
            "message" => "添加成功",
            ];
    }
}
