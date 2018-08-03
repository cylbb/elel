@extends("layouts.admin.default")
@section('title',"菜品统计表")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <form action="" class="form-inline" method="get" style="float: right">
                        <select name="shop_id" class="form-control">
                            <option value="">请选择店铺</option>
                            @foreach($shops as $shop)
                                <option value="{{$shop->id}}"
                                        @if($shop->id==request()->input('shop_id')) selected @endif >{{$shop->shop_name}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>
                        </button>
                    </form>


                </div>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>菜品名称</th>
                    <th>菜品数量</th>
                </tr>
                @foreach($goods as $good)
                    <tr>
                        <td>{{$good->goods_name}}</td>
                        <td>{{$good->nums}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
