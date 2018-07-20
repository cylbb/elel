@extends("layouts.admin.default")
@section("title","商家分类表")
@section("content")
    <table class="table table-bordered">
        <a href="{{route('shop_category.add')}}" class="btn btn-success">添加</a>
        <tr>
         <th>ID</th>
         <th>分类名称</th>
         <th>图片</th>
         <th>状态</th>
         <th>操作</th>
        </tr>
        @foreach($cates as $cate)
            <tr>
                <td>{{$cate->id}}</td>
                <td>{{$cate->name}}</td>
                <td>
                    @if($cate->logo)
                        <img src="/uploads/{{$cate->logo}}" width="40px" height="50">
                    @endif
                </td>
                <td>{{$cate->status}}</td>
                <td>
                    <a href="{{route('shop_category.edit',$cate)}}" class="btn btn-primary">编辑</a>
                    <a href="{{route('shop_category.del',$cate)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
