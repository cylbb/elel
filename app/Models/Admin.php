<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;
    protected $guard_name = 'admin';
    //设置可修改字段
    public $fillable=['name','password','email','remember'];
}
