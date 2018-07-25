@extends("layouts.shop.default")
@section("title","菜品管理")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{route('menu.add')}}" class="btn btn-success">添加</a>
                    <div class="box-tools">
    <form action="" class="form-inline">
        <select name="category_id" class="form-control">
            <option value="">请选择分类</option>
            @foreach($cates as $cate)
                <option value="{{$cate->id}}"
                        {{--@if($cate->id==request()->input('category_id')) selected @endif--}} >{{$cate->name}}</option>
            @endforeach
        </select>
        <input type="text" name="minPrice" class="form-control" size="2" placeholder="最低价"
               value="{{request()->input('minPrice')}}">
        <input type="text" name="maxPrice" class="form-control" size="2" placeholder="最高价"
               value="{{request()->input('maxPrice')}}">
        <input type="text" name="keyword" class="form-control" placeholder="菜品名称"
               value="{{request()->input('keyword')}}">
        <input type="submit" value="搜索" class="btn btn-success">
    </form>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>评分</th>
            <th>所属商家</th>
            <th>所属分类</th>
            <th>价格</th>
            <th>描述</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>提示信息</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>商品图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->goods_name}}</td>
                <td>{{$menu->rating}}</td>
                <td>{{$menu->shop->shop_name}}</td>
                <td>{{$menu->cate->name}}</td>
                <td>{{$menu->goods_price}}</td>
                <td>{{$menu->description}}</td>
                <td>{{$menu->month_sales}}</td>
                <td>{{$menu->rating_count}}</td>
                <td>{{$menu->tips}}</td>
                <td>{{$menu->satisfy_count}}</td>
                <td>{{$menu->satisfy_rate}}</td>
                <td>  @if($menu->goods_logo)
                        <img src="/uploads/{{$menu->goods_logo}}" width="40px" height="50">
                    @endif</td>
                <td>
                    @if($menu->status)
                   <i class="glyphicon glyphicon-ok" style="color: green"></i>
                        @else
                    <i class="glyphicon glyphicon-remove" style="color:red"></i>
                        @endif
                </td>
                <td>
                    <a href="{{route('menu.edit',$menu)}}" class="btn btn-primary">编辑</a>
                    <a href="{{route('menu.del',$menu)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
                </div>
            </div>
        </div>
    </div>
    {{$menus->links()}}
@endsection
