@extends("layouts.admin.default")
@section("title","编辑商家信息")
@section("content")
    <form action="" method="post" class="form-group" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="shop_category_id" class="col-sm-2 control-label">店铺分类</label>
            <div class="col-sm-4">
                <select class="form-control" name="shop_category_id">
                    <option>请选择类型:</option>
                    @foreach($cates as $cate)
                        <option value="{{$cate->id}}" <?php if($cate->id===$shop->shop_category_id) echo "selected";?>>{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
            <label for="shop_name" class="col-sm-1 control-label">店铺名称</label>
            <div class="col-sm-4">
                <input type="text" name="shop_name" placeholder="店铺名称" class="form-control" value="{{old('shop_name',$shop->shop_name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="shop_rating" class="col-sm-2 control-label">评分</label>
            <div class="col-sm-4">
                <input type="text" name="shop_rating" placeholder="评分" class="form-control"
                       value="{{old('shop_rating',$shop->shop_rating)}}">
            </div>
            <label class="col-sm-1 control-label">LOGO</label>
            <div class="col-sm-4">
                <img src="/uploads/{{$shop->shop_logo}}" alt="" height="40">
                <input type="file" class="form-control" name="shop_logo">
            </div>
        </div>
        <div class="form-group">
            <label for="start_send" class="col-sm-2 control-label">起送金额</label>
            <div class="col-sm-4">
                <input type="text" name="start_send" placeholder="起送金额" class="form-control"
                       value="{{old('start_send',$shop->start_send)}}">
            </div>
            <label for="send_cost" class="col-sm-1 control-label">配送费</label>
            <div class="col-sm-4">
                <input type="text" name="send_cost" placeholder="配送费" class="form-control" value="{{old('send_cost',$shop->send_cost)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="notice" class="col-sm-2 control-label">店铺公告</label>
            <div class="col-sm-4">
                <input type="text" name="notice" placeholder="店铺公告" class="form-control" value="{{old('notice',$shop->notice)}}">
            </div>
            <label for="discount" class="col-sm-1 control-label">优惠信息</label>
            <div class="col-sm-4">
                <input type="text" name="discount" placeholder="优惠信息" class="form-control" value="{{old('discount',$shop->discount)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="brand" class="col-sm-2 control-label">是否品牌</label>
            <div class="col-sm-10">
                <input type="radio" name="brand" class="form-group" value="1" {{$shop->brand==1?"checked":""}}>是
                </label>
                <label>
                    <input type="radio" name="brand" class="form-group" value="0" {{$shop->brand==0?"checked":""}}>否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="on_time" class="col-sm-2 control-label">是否准时送达</label>
            <div class="col-sm-10">
                <input type="radio" name="on_time" class="form-group" value="1" {{$shop->on_time==1?"checked":""}}>是
                </label>
                <label>
                    <input type="radio" name="on_time" class="form-group" value="0" {{$shop->on_time==0?"checked":""}}>否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="fengniao" class="col-sm-2 control-label">是否蜂鸟</label>
            <div class="col-sm-10">
                <input type="radio" name="fengniao" class="form-group" value="1" {{$shop->fengniao==1?"checked":""}}>是
                </label>
                <label>
                    <input type="radio" name="fengniao" class="form-group" value="0"
                            {{$shop->fengniao==0?"checked":""}}>否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="bao" class="col-sm-2 control-label">是否保标记</label>
            <div class="col-sm-10">
                <input type="radio" name="bao" class="form-group" value="1" {{$shop->bao==1?"checked":""}}>是
                </label>
                <label>
                    <input type="radio" name="bao" class="form-group" value="0" {{$shop->bao==0?"checked":""}}>否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="piao" class="col-sm-2 control-label">是否票标记</label>
            <div class="col-sm-10">
                <input type="radio" name="piao" class="form-group" value="1" {{$shop->piao==1?"checked":""}}>是
                </label>
                <label>
                    <input type="radio" name="piao" class="form-group" value="0" {{$shop->piao==0?"checked":""}}>否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="zhun" class="col-sm-2 control-label">是否准标记</label>
            <div class="col-sm-10">
                <input type="radio" name="zhun" class="form-group" value="1" {{$shop->zhun==1?"checked":""}}>是
                </label>
                <label>
                    <input type="radio" name="zhun" class="form-group" value="0" {{$shop->zhun==0?"checked":""}}>否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">姓名</label>
            <div class="col-sm-10">
                <input type="text" class="form-group" id="name" placeholder="name" name="name" value="{{old('name',$user->name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="text" class="form-group" id="email" placeholder="email" name="email" value="{{old('email',$user->email)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-group" id="password" placeholder="password" name="password" value="{{old('password',$user->password)}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">编辑</button>
            </div>
        </div>
    </form>
@endsection