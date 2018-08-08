<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //设置可修改的字段
    public $fillable=['title','content','start_time','end_time','prize_time','num','is_prize'];
}
