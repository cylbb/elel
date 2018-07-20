<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCategoryController extends Controller
{
    public function index(){
        //得到所有数据
        $cates=ShopCategory::all();
        //显示视图
        return view('admin.shop_category.index',compact('cates'));
    }
}
