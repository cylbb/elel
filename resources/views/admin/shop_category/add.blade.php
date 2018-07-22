@extends("layouts.admin.default")
@section("title","商家添加")
@section("content")
    <form action="" method="post" class="form-group" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">商家名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" placeholder="名称" class="form-group" value="{{old('name')}}">
            </div>
        </div>


        <div class="form-group">
            <label for="status" class="col-sm-2 control-label">状态</label>
            <div class="col-sm-10">
                <input type="radio" name="status" class="form-group" value="1" checked>显示
                </label>
                <label>
                    <input type="radio" name="status" class="form-group" value="0">隐藏
                </label>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">LOGO</label>
            <div class="col-sm-10">
                <input type="file" class="form-group" name="logo">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="添加" class="btn btn-success">
            </div>
    </form>
@endsection