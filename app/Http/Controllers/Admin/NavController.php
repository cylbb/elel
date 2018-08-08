<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class NavController extends BaseController
{
    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $navs=Nav::paginate(3);
        return view('admin.nav.index',compact('navs'));
    }
    /**
     * 添加导航
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request){
     if($request->isMethod('post')){
         $this->validate($request,[
             'name'=>'required',
         ]);
         if ($request->post('url')===null){
             $data=$request->except('url');
         }else{
             $data=$request->post();
         }
         $nav=Nav::create($data);
         return redirect()->route('nav.index')->with('success','添加'.$nav->name.'成功');
     }
        $routes=Route::getRoutes();
        $urls=[];
        foreach ($routes as $k=>$value){
            if(isset($value->action['namespace'])){
                if($value->action['namespace']==="App\Http\Controllers\Admin"){

                    if (isset($value->action['as'])){
                        $urls[]=$value->action['as'];
                    }
                }
            }

        }
        $navs=Nav::where('parent_id',0)->orderBy('sort')->get();
        return view('admin.nav.add',compact('navs','urls'));
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     */
    public function edit(Request $request,$id){
//       $navId=Nav::find($id);
//       if($request->isMethod('post')){
//           $this->validate($request,[
//               'name'=>'required',
//           ]);
//           if ($request->post('url')===null){
//               $data=$request->except('url');
//           }else{
//               $data=$request->post();
//           }
//           $navId->update($data);
//           return redirect()->route('nav.index')->with('success','添加'.$navId->name.'成功');
//       }
//        $routes=Route::getRoutes();
//        $urls=[];
//        foreach ($routes as $k=>$value){
//            if(isset($value->action['namespace'])){
//                if($value->action['namespace']==="App\Http\Controllers\Admin"){
//
//                    if (isset($value->action['as'])){
//                        $urls[]=$value->action['as'];
//                    }
//                }
//            }
//
//        }
//        $navs=Nav::where('parent_id',0)->orderBy('sort')->get();
//        return view('admin.nav.edit',compact('navs','urls','navId'));
   }
}
