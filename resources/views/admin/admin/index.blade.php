@extends("layouts.admin.default")
@section("title","管理员列表")
@section("content")
    <table class="table table-bordered">
        <tr>
         <th>ID</th>
         <th>名字</th>
         <th>邮箱</th>
         <th>角色名称</th>
         <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{str_replace(',',' | ',str_replace(['[',']','"'],'',
    json_encode($admin->getRoleNames(),JSON_UNESCAPED_UNICODE)))}}</td>
                <td>
                    <a href="{{route('admin.edit',$admin)}}" class="btn btn-primary">编辑</a>
                    <a href="{{route('admin.del',$admin)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$admins->links()}}
@endsection
