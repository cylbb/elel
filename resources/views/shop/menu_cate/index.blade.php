@extends("layouts.shop.default")
@section("content")
    <a href="{{route('cate.add')}}" class="btn btn-success">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>菜品编号</th>
            <th>所属商家</th>
            <th>描述</th>
            <th>分类</th>
            <th>操作</th>
        </tr>
        @foreach($cates as $cate)
            <tr>
                <td>{{$cate->id}}</td>
                <td>{{$cate->name}}</td>
                <td>{{$cate->type_accumulation}}</td>
                <td>{{$cate->shop->shop_name}}</td>
                <td>{{$cate->description}}</td>
                <td>
                    @if($cate->is_selected==1&&$cate->id==1)
                   <i class="glyphicon glyphicon-ok" style="color: green"></i>
                        @else
                    <i class="glyphicon glyphicon-remove" style="color:red"></i>
                        @endif
                </td>
                <td>
                    <a href="{{route('cate.edit',$cate)}}" class="btn btn-primary">编辑</a>
                    <a href="{{route('cate.del',$cate)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$cates->links()}}
@endsection
