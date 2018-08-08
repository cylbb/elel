<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PerController extends Controller
{
    //权限列表
    public function index(){
        $pers=Permission::all();
    }
    //添加权限
    public function add(){
        //添加权限
      $per=Permission::create(['name'=>'orders.goodMonth','guard_name'=>'admin']);
    }
    //删除权限
    public function del($id){
        $per=Permission::findOrFail($id);
        $per->delete();
    }
}
