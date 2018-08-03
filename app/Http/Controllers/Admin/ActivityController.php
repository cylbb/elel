<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends BaseController
{
    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        //取出所有的数据
           $activites=Activity::paginate(3);
           //显示视图
        return view('admin.activity.index',compact('activites'));
    }
    public function unStart(){
        $time=date('Y-m-d',time());
        //取出所有的数据
        $activites=Activity::whereDate('start_time','>',$time)->paginate(3);
        //显示视图
        return view('admin.activity.index',compact('activites'));
    }

    public function going(){
        $time=date('Y-m-d',time());
        //取出所有的数据
        $activites=Activity::whereDate('start_time','<=',$time)
            ->whereDate('end_time','>=',$time)
            ->paginate(3);
        //显示视图
        return view('admin.activity.index',compact('activites'));
    }
    public function over(){
        $time=date('Y-m-d',time());
        //取出所有的数据
        $activites=Activity::whereDate('end_time','<',$time)
            ->paginate(3);
        //显示视图
        return view('admin.activity.index',compact('activites'));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request){
        //判断是不是post提交
        if($request->isMethod('post')){
            //验证数据合法
            $this->validate($request,[
                'title' => "required|min:4",
                'content' => "required|min:6",
            ]);
            //插入数据
            Activity::create($request->all());
            //提示
            $request->session()->flash('success',"添加成功");
            //跳转
            return redirect()->route('activitys.index');
        }
        //显示视图
        return view('admin.activity.add');
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id){
        //通过id找到数据
        $activity=Activity::find($id);
        //判断提交方式是不是post
        if($request->isMethod('post')){
            //验证数据是否合法
            $this->validate($request,[
                'title' => "required|min:4",
                'content' => "required|min:6",
            ]);
            //修改数据
               $activity->update($request->all());
               //提示
            $request->session()->flash('success',"编辑成功");
            //跳转
            return redirect()->route('activitys.index');
        }
        //显示视图
        return view('admin.activity.edit',compact('activity'));
    }
    public function del(Request $request,$id){
        //通过id找到数据
        $activity=Activity::findOrFail($id);
        //删除数据
        $activity->delete();
        //提示信息
        $request->session()->flash('success','删除成功');
        //跳转
        return redirect()->route('activitys.index');
    }
}
