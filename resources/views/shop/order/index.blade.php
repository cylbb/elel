@extends("layouts.shop.default")
@section('title',"订单列表")
@section("content")
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>所属商家</th>
            <th>货号</th>
            <th>名字</th>
            <th>电话</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->shop->shop_name}}</td>
                <td>{{$order->sn}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->tel}}</td>
                <td>
                    @if($order->status==-1)
                        <i>已取消</i>
                        @elseif($order->status==0)
                        <i>代付款</i>
                        @elseif($order->status==1)
                        <i>待发货</i>
                    @elseif($order->status==2)
                        <i>待确认</i>
                    @elseif($order->status==3)
                        <i>完成</i>
                    @endif
                </td>
                <td>
                    <a href="{{route('order.show',$order)}}" class="btn btn-primary">查看订单</a>
                    <a href="{{route('order.cancel',$order)}}" class="btn btn-danger">取消订单</a>
                    <a href="{{route('order.send',$order)}}" class="btn btn-success">发货</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
