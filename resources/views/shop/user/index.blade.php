@extends("layouts.shop.default")
@section("content")
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>店铺分类</th>
            <th>名称</th>
            <th>图片</th>
            <th>评分</th>
            <th>品牌</th>
            <th>准时</th>
            <th>蜂鸟</th>
            <th>保标记</th>
            <th>票标记</th>
            <th>准标记</th>
            <th>起送金额</th>
            <th>配送费</th>
            <th>公告</th>
            <th>优惠信息</th>
            <th>审核</th>
        </tr>
        @foreach($shops as $shop)
        <tr>
            <td>{{$shop->id}}</td>
            <td>{{$shop->cate->name}}</td>
            <td>{{$shop->shop_name}}</td>
            <td>
                @if($shop->shop_logo)
                    <img src="/uploads/{{$shop->shop_logo}}" width="40px" height="50">
                @endif
            </td>
            <td>{{$shop->shop_rating}}</td>
            <td>
                @if($shop->brand)
                    <i class="glyphicon glyphicon-ok" style="color: green"></i>
                @else
                    <i class="glyphicon glyphicon-remove" style="color: red"></i>
                @endif
            </td>
            <td>
                @if($shop->on_time)
                    <i class="glyphicon glyphicon-ok" style="color: green"></i>
                @else
                    <i class="glyphicon glyphicon-remove" style="color: red"></i>
                @endif
            </td>
            <td>
                @if($shop->fengniao)
                    <i class="glyphicon glyphicon-ok" style="color: green"></i>
                @else
                    <i class="glyphicon glyphicon-remove" style="color: red"></i>
                @endif
            </td>
            <td>
                @if($shop->bao)
                    <i class="glyphicon glyphicon-ok" style="color: green"></i>
                @else
                    <i class="glyphicon glyphicon-remove" style="color: red"></i>
                @endif
            </td>
            <td>
                @if($shop->piao)
                    <i class="glyphicon glyphicon-ok" style="color: green"></i>
                @else
                    <i class="glyphicon glyphicon-remove" style="color: red"></i>
                @endif
            </td>
            <td>
                @if($shop->zhun)
                    <i class="glyphicon glyphicon-ok" style="color: green"></i>
                @else
                    <i class="glyphicon glyphicon-remove" style="color: red"></i>
                @endif
            </td>
            <td>{{$shop->start_send}}</td>
            <td>{{$shop->send_cost}}</td>
            <td>{{$shop->notice}}</td>
            <td>{{$shop->discount}}</td>
            <td>
                @if($shop->status===1)
                    <a href="#" onclick="return false" class="btn btn-info"><i class="glyphicon glyphicon-ok-sign"></i></a>
                @elseif($shop->status===0)
                    <a href="{{route('shop.check',$shop)}}" class="btn btn-info"><i class="glyphicon glyphicon-question-sign"></i></a>
                @elseif($shop->status===-1)
                    <a href="#" onclick="return false" class="btn btn-info"><i class="glyphicon glyphicon-ban-circle"></i></a>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@endsection
