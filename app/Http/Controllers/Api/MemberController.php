<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;

class MemberController extends BaseController
{
       //设置短信验证
    public function sms(){
        //接受参数
        $tel=\request()->input('tel');
        //生成验证码
        $code=rand(1000,9999);
        //把验证码存在redis中
        Redis::setex("tel_".$tel,300,$code);
        return [
            "status"=>"true",
            "message"=>"获取短信验证码成功".$code
        ];
        //设置配置
        $config = [
            'access_key' => 'LTAIOGdyO3op8DD5',
            'access_secret' => '6F7b00WOb9HpEn2GM1Zv0AEhHE4pxO',
            'sign_name' => '陈玉铃',
        ];
        $aliSms=new AliSms();

        $response = $aliSms->sendSms($tel, 'SMS_140665169', ['code'=> $code], $config);
// dd($response);
        if($response->Message==="OK"){
            return [
                "status"=>"true",
                "message"=>"获取短信验证码成功"
            ];
        }else{
            //失败
            return [
                "status"=>"false",
                "message"=>$response->Message
            ];
        }
    }

    /**
     * 注册
     * @param Request $request
     * @return array
     */
    public function reg(Request $request){
      //接受参数
        $data=$request->all();
//        dd($data);
        //验证数据是否合法

        $validate=Validator::make($data,[
            'username'=>'required|unique:members',
            'sms' => 'required|integer|min:1000|max:9999',
            'tel'=>[
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/',
                'unique:members'
            ],
            'password'=>'required|min:6'
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
        //验证验证码
        //取出验证码
        $code=Redis::get("tel_".$data['tel']);
        //判断验证码是否正确
        if($code!==$data['sms']){
            return [
                'status' => "false",
                //获取错误信息
                "message" => '验证码错误'
            ];
        }
        //给密码加密
        $data['password']=bcrypt($data['password']);
//        dd($data);
        //插入数据
        Member::create($data);
            //返回信息
            return [
                'status' => "true",
                //获取错误信息
                "message" => "注册成功"
            ];
//          var_dump($data);exit;

   }

    /**
     * 登录
     * @param Request $request
     * @return array
     */
   public function login(Request $request){
       $member = Member::where("username", $request->post('name'))->first();
//       dd($member);
       if ($member && Hash::check($request->post('password'), $member->password)) {
           return [
               'status' => 'true',
               'message' => '登录成功',
               'user_id'=>$member->id,
               'username'=>$member->username
           ];

       }

       return [
           'status' => 'false',
           'message' => '账号或密码错误'
       ];


   }

    /**
     * 重置密码
     * @param Request $request
     */
    public function update(Request $request)
    {
        //得到输入的电话号码
        $data = $request->all();

        //发送短信验证
        //页面验证
        $validate = Validator::make($data, [
            'username' => 'required|unique',
            'password' => 'required|unique',
            'sms' => 'required|integer|min:1000|max:9999',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|18)[0-9]{9}$/',
                'unique:members'
            ]
        ]);
        //如果验证出错
        if ($validate->failed()) {
            //返回错误信息
            return [
                'status' => 'false',
                'message' => $validate->errors()->first()
            ];

        }
        //取出验证码

        $sms = Redis::get("tel_" . $data['tel']);
        //通过电话号码找到用户
        $member = Member::where('tel', $data['tel'])->first();
        if ($member) {
            $data['password'] = bcrypt($data['password']);
            $member->password = $data['password'];
            //入库
            $member->save();
            return [
                "status" => "true",
                "message" => "修改成功"
            ];

        }

    }

    /**
     * 修改密码
     * @param Request $request
     * @param $id
     * @return array
     */
    public function edit(Request $request){
        $data=$request->post();
        $member=Member::findOrFail($data['id']);
        if (Hash::check($request->post('oldPassword'), $member->password)){
            $member->password=bcrypt($data['newPassword']);
            $member->save();
            return [
                "status" => "true",
                "message" => "修改成功"
            ];
            }
    }

    /**
     * 用户信息
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
        return Member::find($request->input('user_id'));
    }

    }
