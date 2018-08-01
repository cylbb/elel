<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //设置可修改字段
    public $fillable=['user_id','shop_id','sn','province','city','county','address',
        'tel','name','order_price','status','created_at','out_trade_no'];
    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }
    public function goods(){
        return $this->hasMany(OrderGood::class,'order_id');
    }
    public function getOrderStatusAttribute()
    {
        $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "完成"];
        return $arr[$this->status];//-1 0 1 2 3
    }
}
