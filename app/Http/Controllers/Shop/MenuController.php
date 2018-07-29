<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategorie;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MenuController extends BaseController
{
    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $shopId=Auth::user()->shop_id;
        //接受参数
        $minPrice=\request()->input('minPrice');
        $maxPrice=\request()->input('maxPrice');
        $keyword=\request()->input('keyword');
        $cateId=\request()->input('category_id');
        $query=Menu::orderBy('id');
        if($minPrice !== null){
            $query= $query->where('goods_price','>=',$minPrice);
        }
        if ($maxPrice!==null){

            $query=  $query->where('goods_price','<=',$maxPrice);
        }
        if ($keyword!==null){

            $query= $query->where('goods_name','like',"%{$keyword}%");

        }
        if ($cateId!==null){

            $query=$query->where('category_id','=',$cateId);

        }
        $menus=$query->where('shop_id',$shopId)->paginate(3);
        $cates=MenuCategorie::all();

        //显示视图
        return view('shop.menu.index',compact('menus','cates'));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request){
        $shops=Shop::all();
        $cates=MenuCategorie::all();
        //判断提交方式
        if($request->isMethod('post')){
           $this->validate($request,[
               'goods_name'=>'required|min:2',
               'goods_price'=>'required|Integer',
               'month_sales'=>'required|Integer',
               'rating_count'=>'required|Integer',
               'satisfy_count'=>'required|Integer'
           ]);
           //接受数据
            $data=$request->all();
            $data['goods_logo']="";
            if($request->file('goods_logo')){
                //得到上传路径
                $fileName= $request->file('goods_logo')->store("menus","images");
                //判断有木有图片，如果有就上传，如果没有就为空
                $data['goods_logo']=$fileName;
            }
            Menu::create($data);
            //提示
            $request->session()->flash('success',"添加成功");
            //跳转
            return redirect()->route('menu.index');
        }
        //显示视图
        return view('shop.menu.add',compact('shops','cates'));
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     */
    public function edit(Request $request,$id){
        $shops=Shop::all();
        $cates=MenuCategorie::all();
        //通过id找到数据
        $menu=Menu::find($id);
        //判断提交方式
        if($request->isMethod('post')){
            $this->validate($request,[
                'goods_name'=>'required|min:2',
                'month_sales'=>'required|Integer',
                'rating_count'=>'required|Integer',
                'satisfy_count'=>'required|Integer'
            ]);
            //接受数据
            $data=$request->all();
            //得到上传路径
            if (isset($data['goods_logo'])) {
                $fileName= $request->file('goods_logo')->store("menus","images");
            }

            $data['goods_logo']=$fileName??"";

            //判断有木有图片，如果有就上传，如果没有就为空
            if($data['goods_logo']===""){
                $data['goods_logo']=$menu->goods_logo;
            }else{
                File::delete("uploads/".$menu->goods_logo);
            }
            $menu->update($data);
            //提示
            $request->session()->flash('success',"编辑成功");
            //跳转
            return redirect()->route('menu.index');
        }
        //显示视图
        return view('shop.menu.edit',compact('shops','cates'),compact('menu'));
    }

    /**
     * 删除
     * @param Request $request
     * @param $id
     */
    public function del(Request $request,$id){
        $menu=Menu::findOrFail($id);
        File::delete("uploads/".$menu->goods_logo);
        $menu->delete();
        //提示
        $request->session()->flash('success','删除成功');
        //跳转
        return redirect()->route('menu.index');
    }
}
