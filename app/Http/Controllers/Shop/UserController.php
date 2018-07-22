<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{

    public function index()
    {
        //得到所有的数据
        $users=User::all();
        $shops=Shop::all();
        //显示视图
        return view("shop.user.index", compact('users','shops'));
    }

    /**
     * 注册
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function reg(Request $request)
    {
        $cates=ShopCategory::all();
        //判断提交方式是否是post
        if ($request->isMethod('post')) {
            //验证数据是否合法
            $this->validate($request, [
                'name' => 'required|min:2',
                'email' => 'required|min:6',
                'password' => 'required|min:6',
                'captcha' => 'required|captcha'
            ]);
            //接受数据
            $data = $request->all();
            $data['shop_logo']="";
            if($request->file('shop_logo')){
                //得到上传路径
                $fileName= $request->file('shop_logo')->store("users","images");
                //判断有木有图片，如果有就上传，如果没有就为空
                $data['shop_logo']=$fileName;
            }
            //插入数据
            $shop=Shop::create($data);
            User::create([
                'shop_id'=>$shop->id,
                'name'=>$request->post('name'),
                'email'=>$request->post('email'),
                'password'=>bcrypt($request->post('password')),
                'status'=>0
            ]);
            $request->session()->flash('success', "注册成功");
            //跳转
            return redirect()->route('user.login');
        }
        //显示视图
        return view("shop.user.reg",compact('cates'));
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
//    public function edit(Request $request, $id)
//    {
//        $cates=ShopCategory::all();
//        //通过id找到数据
//        $shop=Shop::find($id);
//        $user = User::find($id);
//        //判断提交方式是不是post
//        if ($request->isMethod('post')) {
//            //验证数据是否合法
//            $this->validate($request, [
//                'name' => 'required|min:2',
//                'email' => 'required|min:6',
//                'password' => 'required|min:6',
//            ]);
//            //接受数据
//            $data = $request->all();
//            //加密密码
//            $data['password'] = bcrypt($data['password']);
//            //修改数据
//            $shop->update($data);
//            $user->update($data);
//            //提示信息
//            $request->session()->flash('success', "编辑成功");
//            //跳转
//            return redirect()->route('user.index');
//        }
//        //显示视图
//        return view('shop.user.edit', compact('user','shop'),compact('cates'));
//    }

    /**
     * 删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
//    public function del(Request $request, $id)
//    {
//        //通过id找数据
//        $user = User::find($id);
//        $shop = Shop::find($id);
//        //删除数据
//        $user->delete();
//        $shop->delete();
//        //提示信息
//        $request->session()->flash("succes", "删除成功");
//        //跳转
//        return redirect()->route("user.index");
//
//    }
    /**
     * 登录
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function login(Request $request){
     //判断提交方式是不是post提交
        if($request->isMethod('post')){
            //验证数据是否合法
            $this->validate($request, [
                'name' => 'required|min:2',
                'password' => 'required|min:6',
            ]);
            //登录

            if(Auth::attempt(['name'=>$request->post('name'),'password'=>$request->post('password')],$request->has('remember'))){
                //提示
                $request->session()->flash('success',"登录成功");
                //跳转
                return redirect()->route('user.index');
            }else{
                //提示
                $request->session()->flash('danger',"账号或密码错误");
                //跳转
                return redirect()->back()->withInput();
            }
        }
        //显示视图
        return view('shop.user.login');
    }
    public function update(Request $request)
    {
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'old_password' => "required",
                'password' => "required|confirmed|min:6"
            ]);
            $id = Auth::user()->id;
            //查询数据
            $user = User::select("password")->where("id", "=", $id)->first();
            $old_password = $request->post("old_password");
            if (!Hash::check($old_password, $user->password)) {
                //提示
                $request->session()->flash("danger", "旧密码错误");
                //跳转
                return redirect()->back()->withInput();
            }
            $password = bcrypt($request->post("password"));
            //更新数据
            $result = User::where('id', '=', $id)->update(['password' => $password]);
            if ($result) {
                //提示
                $request->session()->flash("success", "密码修改成功");
                Auth::logout();
                //跳转
                return redirect()->route("user.login");
            } else {
                //提示
                $request->session()->flash("danger", "密码输入错误");
                //跳转
                return redirect()->back()->withInput();
            }
        }
        return view('shop.user.update');
    }

    /**
     * 退出
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request){
        //退出
        Auth::logout();
        //提示
        $request->session()->flash('success',"退出成功");
        //跳转
        return redirect()->route('user.login');
    }
}
