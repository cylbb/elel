<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        //得到所有的数据
        $shops=Shop::all();
        //显示视图
        return view('admin.shop.index',compact('shops'));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request){
        $cates=ShopCategory::all();
       //判断提交方式是不是post
        if($request->isMethod('post')){
            $this->validate($request,[
                'shop_category_id'=>'required',
                'shop_name'=>'required|min:2',
                'start_send'=>'required',
                'send_cost'=>'required',
                'captcha'=> 'required|captcha'
            ]);
            //得到数据
            $data=$request->all();
            $data['status']=0;
            $data['shop_logo']="";
            if($request->file('shop_logo')){
                //得到上传路径
                $fileName= $request->file('shop_logo')->store("shops","images");
                //判断有木有图片，如果有就上传，如果没有就为空
                $data['shop_logo']=$fileName;
            }
            Shop::create($data);
            //跳转
            return redirect()->route('shop.index');
        }
        //显示视图
        return view('admin.shop.add',compact('cates'));
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     */
     public function edit(Request $request,$id){
         $cates=ShopCategory::all();
         //通过id找到数据
         $shop=Shop::find($id);
         //判断提交方式是不是post提交
         if($request->isMethod('post')){
             $this->validate($request,[
                 'shop_category_id'=>'required',
                 'shop_name'=>'required|min:2',
                 'start_send'=>'required',
                 'send_cost'=>'required',
             ]);
             //得到所有的数据
             $data=$request->all();
             //得到上传路径
             if (isset($data['shop_logo'])) {
                 $fileName= $request->file('shop_logo')->store("shops","images");
             }

             $data['shop_logo']=$fileName??"";

             //判断有木有图片，如果有就上传，如果没有就为空
             if($data['shop_logo']===""){
                 $data['shop_logo']=$shop->shop_logo;
             }else{
                 @unlink($shop->shop_logo);
             }
             //修改数据
             $shop->update($data);
             //信息提示
             $request->session()->flash('success',"编辑成功");
             //跳转
             return redirect()->route('shop.index');
         }
         //显示视图
         return view('admin.shop.edit',compact('shop','cates'));
     }

    /**
     * 删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
     public function del(Request $request,$id){
         //通过id找到数据
         $shop=Shop::find($id);
         @unlink($shop->shop_logo);
         $shop->delete();
         //跳转
         return redirect()->route('shop.index');
     }
     public function check(Request $request,$id){
         //通过id找到数据
         $shop=Shop::find($id);
         $shop->status=1;
         if($shop->update($request->all())){
             //提示
             $request->session()->flash('success',"商家审核通过");
             //跳转
             return redirect()->route('shop.index');
         }else{
             $shop->status=-1;
             //提示
             $request->session()->flash('success','商家审核失败');
             //跳转
             return redirect()->route('shop.index');
         }
     }
}
