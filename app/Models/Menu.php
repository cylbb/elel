<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //设置可修改字段
    public $fillable=['goods_name','rating','shop_id','category_id',
        'goods_price','description','month_sales','rating_count',
        'tips','satisfy_count','satisfy_rate','goods_logo','status'
    ];
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
    public function cate(){
        return $this->belongsTo(MenuCategorie::class,'category_id');
    }
}
