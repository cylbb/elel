<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index()
    {
        //得到所有的数据
        $users = User::all();
        //显示视图
        return view("shop.user.index", compact('users'));
    }

    /**
     * 注册
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function reg(Request $request)
    {
        $shops=Shop::all();
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
            //加密密码
            $data['password'] = bcrypt($data['password']);
            //插入数据
            User::create($data);
            $request->session()->flash('success', "注册成功");
            //跳转
            return redirect()->route('user.index');
        }
        //显示视图
        return view("shop.user.reg",compact('shops'));
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        //通过id找到数据
        $user = User::find($id);
        //判断提交方式是不是post
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
            //加密密码
            $data['password'] = bcrypt($data['password']);
            //修改数据
            $user->update($data);
            //提示信息
            $request->session()->flash('success', "编辑成功");
            //跳转
            return redirect()->route('user.index');
        }
        //显示视图
        return view('shop.user.edit', compact('user'));
    }

    /**
     * 删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request, $id)
    {
        //通过id找数据
        $user = User::find($id);
        //删除数据
        $user->delete();
        //提示信息
        $request->session()->flash("succes", "删除成功");
        //跳转
        return redirect()->route("user.index");

    }
}
