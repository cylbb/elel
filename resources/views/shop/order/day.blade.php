@extends("layouts.shop.default")
@section('title',"订单量每日统计表")
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
            <th>总额</th>
            <th>订单数量</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->day}}</td>
                <td>{{$order->money}}</td>
                <td>{{$order->count}}</td>
            </tr>
        @endforeach
    </table>
        </div>
    </div>
@endsection
