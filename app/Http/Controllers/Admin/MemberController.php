<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends BaseController
{
    public function index(Request $request)
    {
        $query=$request->query();
        //接收页面传过来的参数
        $search=$request->input('search');

        $members=Member::where('username','like',"%$search%")->paginate(3);
        //显示页面
        return view('admin.member.index',compact('query','members'));
    }
    /**
     * 会员详细信息
     * @param Request $request
     * @param $id
     */
    public function info(Request $request,$id)
    {

        $member=Member::findOrFail($id);
//        dd($member);
        //显示页面
        return view('admin.member.see',compact('member'));

    }

    //检验是否审核过

    public function check(Request $request, $id)
    {
        //通过id找到对象
        $member = Member::find($id);
        //判断是不是post提交
        if ($request->isMethod('post')) {
            //充值
            $member->money += $request->post('money');
            if ($member->save()) {
                //提示
                $request->session()->flash('success', "充值成功");
                //跳转
                return redirect()->route('member.index');
            }
        }
        //显示视图
        return view("admin.member.check");

    }
}
