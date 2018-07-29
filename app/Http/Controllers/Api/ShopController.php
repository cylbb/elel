<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\MenuCategorie;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    //提供店铺列表
    public function list(Request $request){
        $keyword = $request->input('keyword') ? $request->input('keyword') : "";
        $shops=Shop::where('status',1)->where('shop_name', 'like', "%$keyword%")->get();
        //循环取出数据
        foreach ($shops as $shop){
            $shop->shop_img="/uploads/".$shop->shop_logo;
            $shop->distance=rand(1000,5000);
            $shop->estimate_time= $shop->distance / 100;
        }
        return $shops;
//        var_dump($shops);exit;
    }
    public function index(Request $request){
      $id=$request->input('id');
//      dd($id);
      $shop=Shop::findOrFail($id);
        $shop->shop_img="/uploads/".$shop->shop_logo;
        $shop->distance=rand(1000,5000);
        $shop->estimate_time= $shop->distance / 100;
        //添加评论
        $shop->evaluate = [
            [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 1,
                "send_time" => 30,
                "evaluate_details" => "不怎么好吃"],
            [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 4.5,
                "send_time" => 30,
                "evaluate_details" => "很好吃"]
        ];
        //先取出分类
        $cates=MenuCategorie::where('shop_id',$id)->get();
        foreach ($cates as $cate){
            $goods=Menu::where('category_id',$cate->id)->get();

            foreach ($goods as $k=>$v){
                $goods[$k]->goods_img="/uploads/".$v->goods_logo;
            }
            $cate->goods_list=$goods;
        }

//        var_dump($shop);exit;
        //再把分类数据追加到$shop
        $shop->commodity=$cates;
        return $shop;
    }
}
