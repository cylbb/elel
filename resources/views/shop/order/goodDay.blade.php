@extends("layouts.shop.default")
@section('title',"菜品每日统计表")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
            <form action="" class="form-inline">
                <input type="date" name="start" class="form-control" size="2" placeholder="开始日期"
                       value="{{request()->input('start')}}"> -
                <input type="date" name="end" class="form-control" size="2" placeholder="结束日期"
                       value="{{request()->input('end')}}">
                <input type="submit" value="搜索" class="btn btn-success">
            </form>


        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>日期</th>
            <th>菜品ID</th>
            <th>菜品名称</th>
            <th>数量</th>
        </tr>
        @foreach($goods as $good)
            <tr>
                <td>{{$good->date}}</td>
                <td>{{$good->goods_id}}</td>
                <td>{{$good->goods_name}}</td>
                <td>{{$good->nums}}</td>
            </tr>
        @endforeach
    </table>
        </div>
    </div>
@endsection
