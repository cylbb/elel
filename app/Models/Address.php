<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //设置可修改字段
    public $fillable=['user_id','name','tel','provence','city','area','detail_address'];
}
