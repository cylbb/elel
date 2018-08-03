<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends BaseController
{
    /**
     * 地址列表
     * @param Request $request
     * @return Address[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request){
        //得到当前用户的id
        $memberId=$request->post('user_id');
        //返回用户的所有地址
        $address=Address::all();
        //返回结果
        return $address;
    }

    /**
     * 添加
     * @param Request $request
     * @return array
     */
   public function add(Request $request){
        //验证数据是否合法
       $validate=Validator::make($request->all(),[
           'name'=>'required',
           'tel'=>[
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/'
            ],
       ]);
       //验证
       if ($validate->fails()) {

           //返回错误
           return [
               'status' => "false",
               //获取错误信息
               "message" => $validate->errors()->first()
           ];

       }
       $data=$request->all();
//       dd($data);
       //插入数据
       Address::create($data);
       //返回数据
       return [
           'status' => "true",
           //获取错误信息
           "message" => "添加成功"
       ];
   }

    /**
     * 返回回显
     * @param Request $request
     * @return mixed
     */
   public function update(Request $request){
       $id=$request->input('id');
      return $addresse=Address::findOrFail($id);

   }

    /**
     * 编辑
     * @param Request $request
     * @return array
     */
   public function edit(Request $request){
     //接受数据
       $data=$request->post();
       $addresse=Address::findOrFail($data['id']);
       //验证数据是否合法
       $validate=Validator::make($request->all(),[
           'name'=>'required',
           'tel'=>[
               'required',
               'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/'
           ],
       ]);
       //验证
       if ($validate->fails()) {

           //返回错误
           return [
               'status' => "false",
               //获取错误信息
               "message" => $validate->errors()->first()
           ];

       }
       //修改数据
       $addresse->update($data);
       //返回数据
       return [
           'status' => "true",
           //获取错误信息
           "message" => "修改成功"
       ];
   }
}
