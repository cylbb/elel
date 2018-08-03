@extends("layouts.admin.default")
@section("title","管理员编辑")
@section("content")
    <form action="" method="post" class="form-group" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">姓名</label>
            <div class="col-sm-10">
                <input type="text" class="form-group" id="name" placeholder="name" name="name" value="{{old('name',$admin->name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="text" class="form-group" id="email" placeholder="email" name="email" value="{{old('eamil',$admin->email)}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">角色名称</label>
            <div class="col-sm-10">
                @foreach($roles as $role)
                    <input type="checkbox" name="role[]" value="{{$role->name}}" @if($admin->hasRole($role->name)) checked @endif>{{$role->name}}
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">编辑</button>
            </div>
        </div>
    </form>
@endsection