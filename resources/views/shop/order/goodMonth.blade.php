@extends("layouts.shop.default")
@section('title',"菜品每月统计表")
@section("content")

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
@endsection
