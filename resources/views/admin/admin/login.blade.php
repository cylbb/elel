@extends("layouts.admin.default")
@section("title","登录")
@section("content")
    <form action="" method="post" class="form-group" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">姓名</label>
            <div class="col-sm-10">
                <input type="text" class="form-group" id="name" placeholder="name" name="name">
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">密码</label>
                <div class="col-sm-10">
                    <input type="password" class="form-group" id="password" placeholder="password" name="password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> 记住我
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a href="{{route('admin.reg')}}" class="btn btn-primary">注册</a>
                    <button type="submit" class="btn btn-info">登录</button>

                </div>
            </div>
        </div>
    </form>
@endsection