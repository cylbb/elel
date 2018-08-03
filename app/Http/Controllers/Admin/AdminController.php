<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends BaseController
{
    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
       $admins=Admin::paginate(3);
       //显示视图
        return view('admin.admin.index',compact('admins'));
    }

    /**
     * 注册
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reg(Request $request){
        //判断提交方式是不是post
        if($request->isMethod('post')){
            //判断数据是否合法
            $this->validate($request,[
                'name' => "required|min:2",
                'email'=>'required|min:6',
                'password'=>'required|min:6',
            ]);
            $data=$request->all();
            //加密密码
            $data['password']=bcrypt($data['password']);
            //插入数据
            $admin=Admin::create($data);
            $admin->syncRoles($request->post('role'));
            //提示信息
            return redirect()->route('admin.login')->with('success','创建'.$admin->name."成功");
        }
        $roles=Role::all();
        //显示视图
        return view('admin.admin.reg',compact('roles'));
    }

    /**
     * 登录
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(Request $request){
        //判断提交方式是不是post
        if($request->isMethod('post')){
            //判断数据是否合法
            $this->validate($request,[
                'name' => "required|min:2",
                'password'=>'required|min:6',
            ]);
            //登录
            if(Auth::guard('admin')->attempt(['name'=>$request->post('name'),'password'=>$request->post('password')],$request->has('remember'))){
                //提示
                $request->session()->flash('success',"登录成功");
                //跳转
                return redirect()->intended(route('admin.index'));
            }else{
                //提示
                $request->session()->flash('danger',"账号或密码错误");
                //跳转
                return redirect()->back()->withInput();
            }
        }
        //显示视图
        return view('admin.admin.login');
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id){
         //通过id找数据
        $admin=Admin::find($id);
        //判断提交方式是不是post
        if($request->isMethod('post')){
            $this->validate($request,[
                'name' => "required|min:2",
                'email' => "required|max:255"
            ]);
            //更新数据
            $data=$request->all();
            $admin->update($data);
            $admin->syncRoles($request->post('role'));
            //提示
            return redirect()->route('admin.index')->with('success','创建'.$admin->name."成功");
        }
        $roles=Role::all();
        //显示视图
        return view('admin.admin.edit',compact('admin','roles'));
    }

    /**
     * 修改个人密码
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
        public function update(Request $request)
        {
            if ($request->isMethod("post")) {
                //验证
                $this->validate($request, [
                    'old_password' => "required",
                    'password' => "required|confirmed|min:6"
                ]);
                $id = Auth::guard("admin")->user()->id;
                //查询数据
                $admin = Admin::select("password")->where("id", "=", $id)->first();
                $old_password = $request->post("old_password");
                if (!Hash::check($old_password, $admin->password)) {
                    //提示
                    $request->session()->flash("danger", "旧密码错误");
                    //跳转
                    return redirect()->back()->withInput();
                }
                $password = bcrypt($request->post("password"));
                //更新数据
                $result = Admin::where('id', '=', $id)->update(['password' => $password]);
                if ($result) {
                    //提示
                    $request->session()->flash("success", "密码修改成功");
                    Auth::logout();
                    //跳转
                    return redirect()->route("admin.login");
                } else {
                    //提示
                    $request->session()->flash("danger", "密码输入错误");
                    //跳转
                    return redirect()->back()->withInput();
                }
            }
        return view('admin.admin.update');
    }

    /**
     * 删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
       public function del(Request $request,$id){
           if ($id == 1) {
               return back()->with("danger", "1不能删除");
           }
           //通过id找到对象
           $admin = Admin::findOrFail($id);
           //删除数据
           $admin->delete();
           //提示
           $request->session()->flash("success", "删除成功");
           //跳转
           return redirect()->route("admin.index");
       }
    /**
     * 退出
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request){
        //退出
        Auth::guard('admin')->logout();
          //提示
        $request->session()->flash('success',"退出成功");
        //跳转
        return redirect()->route('admin.login');
    }
}
