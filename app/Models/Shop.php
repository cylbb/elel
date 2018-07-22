<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //设置可修改字段
    public $fillable=['shop_category_id','shop_name','shop_logo','shop_rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','discount','status'];
    public function cate(){
      return $this->belongsTo(ShopCategory::class,'shop_category_id');
    }
    public function user(){
        return $this->hasOne(User::class,'id');
    }
}
