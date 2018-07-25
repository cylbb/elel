<?php

namespace App\Http\Controllers\Shop;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    public function index(){
        $time=date("Y-m-d",time());

        $activitys=Activity::where('end_time','>',$time)->paginate(3);
//        dd($time);
        //显示视图
        return view('shop.activity.index',compact('activitys'));
    }
    public function show($id){
        $activity=Activity::find($id);
        //显示视图
        return view('shop.activity.show',compact('activity'));
    }
}
