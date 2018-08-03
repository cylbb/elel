@extends("layouts.shop.default")
@section('title',"订单量每月统计表")
@section("content")

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
@endsection
