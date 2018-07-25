<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategorie;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuCateController extends Controller
{
    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        //得到所有得数据
        $cates=MenuCategorie::paginate(3);
        //显示视图
        return view('shop.menu_cate.index',compact('cates'));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request){
        $shops=Shop::all();
       //判断是否是post提交
        if($request->isMethod('post')){
            //验证数据是否合法
            $this->validate($request,[
                'name' => "required|min:2",
            ]);
            //插入数据
            MenuCategorie::create($request->all());
            //提示
            $request->session()->flash('success',"添加成功");
            //跳转
            return redirect()->route('cate.index');
        }
        //显示视图
        return view('shop.menu_cate.add',compact('shops'));
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id){
        $shops=Shop::all();
       //通过id找数据
        $cate=MenuCategorie::find($id);
        //判断提交方式是不是post
        if($request->isMethod('post')){
            $this->validate($request,[
                'name' => "required|min:2",
            ]);
            //修改数据
            $cate->update($request->all());

            //提示
            $request->session()->flash("success","编辑成功");
            //跳转
            return redirect()->route('cate.index');
        }
        //显示视图
        return view('shop.menu_cate.edit',compact('cate','shops'));
    }

    /**
     * 删除
     * @param Request $request
     * @param $id
     */
    public function del(Request $request,$id){
        $cate=MenuCategorie::findOrFail($id);
        $menu=Menu::where('category_id','=',$id)->first();
        if($menu['category_id']==$id){
            //提示
            $request->session()->flash("info","该分类有菜品,不能被删除");
            //跳转
            return redirect()->back();
        }
        $cate->delete();
        //提示
        $request->session()->flash('success',"删除成功");
        //跳转
        return redirect()->route('cate.index');
    }
}
