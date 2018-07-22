<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCategoryController extends Controller
{
    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        //得到所有数据
        $cates=ShopCategory::all();
        //显示视图
        return view('admin.shop_category.index',compact('cates'));
    }

    /**
     * 添加
     * @param Request $request
     */
    public function add(Request $request){
         //判断是不是post提交
        if($request->isMethod('post')){
            //接受数据
            $data=$request->all();
            $data['logo']="";
            if($request->file('logo')){
                //得到上传路径
                $fileName= $request->file('logo')->store("cates","images");
                //判断有木有图片，如果有就上传，如果没有就为空
                $data['logo']=$fileName;
            }

            //插入数据
            ShopCategory::create($data);
            //提示
            $request->session()->flash('success',"添加成功");
            //跳转
            return redirect()->route('shop_category.index');
        }
        //显示视图
        return view('admin.shop_category.add');
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id){
        //通过id找数据
          $cate=ShopCategory::find($id);
           //判断提交方式是不是post
        if($request->isMethod('post')){
            //接受数据
            $data=$request->all();
            //得到上传路径
            if (isset($data['logo'])) {
                $fileName= $request->file('logo')->store("cates","images");
            }

            $data['logo']=$fileName??"";

            //判断有木有图片，如果有就上传，如果没有就为空
            if($data['logo']===""){
                $data['logo']=$cate->logo;
            }else{
                @unlink($cate->logo);
            }
            //修改数据
            $cate->update($data);
            //信息提示
            $request->session()->flash('success',"编辑成功");
            //跳转
            return redirect()->route('shop_category.index');
        }
        //显示视图
        return view("admin.shop_category.edit",compact('cate'));
    }
    public function del(Request $request,$id){
        $cate=ShopCategory::find($id);
        @unlink($cate->logo);
        $cate->delete();

        //信息提示
        $request->session()->flash('success',"删除成功");
        //跳转
        return redirect()->route('shop_category.index');
    }
}
