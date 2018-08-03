@extends("layouts.admin.default")
@section("title","权限列表")
@section("content")
    <table class="table table-bordered">
        <a href="{{route('role.add')}}" class="btn btn-success">添加</a>
        <tr>
         <th>ID</th>
         <th>角色名称</th>
         <th>权限名称</th>
         <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{ str_replace(['[',']','"'],'', $role->permissions()->pluck('name')) }}</td>
                <td>
                    <a href="{{route('role.edit',$role)}}" class="btn btn-primary">编辑</a>
                    <a href="{{route('role.del',$role)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
