<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {

        //添加保安 验证登录
        $this->middleware('auth',[
            'except'=>['login','index','reg'],
        ]);
        //再添加一个 login只有guest才能访问
        $this->middleware("guest",[
            'only'=>['login']
        ]);
    }
}
