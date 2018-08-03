<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
      $roles=Role::all();
       //显示视图
        return view('admin.role.index',compact('roles'));
    }

    /**
     * 添加角色和权限
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request){
        //判断提交方式
        if($request->isMethod('post')){
            //接受参数
            $data['name']=$request->post('name');
            $data['guard_name']="admin";
            //创建角色
             $role=Role::create($data);
            $role->syncPermissions($request->post('per'));
            return redirect()->route('role.index')->with('success','创建'.$role->name."成功");
        }
        //得到所有的权限
        $pers=Permission::all();
        return view('admin.role.add',compact('pers'));
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id){
        $role=Role::find($id);
       //判断提交方式
        if($request->isMethod('post')){
            $data['name']=$request->post('name');
            //修改
            $role->update($data);
            $role->syncPermissions($request->post('per'));
            return redirect()->route('role.index')->with('success','修改'.$role->name."成功");
        }
        $pers=Permission::all();
        return view('admin.role.edit',compact('pers','role'));
    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del($id){
         $role=Role::findOrFail($id);
         $role->delete();
        return redirect()->route('role.index');
    }
}
