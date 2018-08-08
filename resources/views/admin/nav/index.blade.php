@extends("layouts.admin.default")
@section("title","导航列表列表")
@section("content")
    <table class="table table-bordered">
        <a href="{{route('nav.add')}}" class="btn btn-success">添加</a>
        <tr>
         <th>ID</th>
         <th>菜品名称</th>
         <th>路由</th>
         <th>上级菜单</th>
         <th>排序</th>
         <th>操作</th>
        </tr>
        @foreach($navs as $nav)
            <tr>
                <td>{{$nav->id}}</td>
                <td>{{$nav->name}}</td>
                <td>{{$nav->url}}</td>
                <td>{{$nav->parent_id}}</td>
                <td>{{$nav->sort}}</td>
                <td>
                    <a href="{{route('nav.edit',$nav)}}" class="btn btn-primary">编辑</a>
                    <a href="{{route('nav.del',$nav)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$navs->links()}}
@endsection
