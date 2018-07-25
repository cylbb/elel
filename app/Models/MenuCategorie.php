<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategorie extends Model
{
    //设置可修改字段
    public $fillable=['name','type_accumulation','shop_id','description','is_selected'];
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}
