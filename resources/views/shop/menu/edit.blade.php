@extends("layouts.shop.default")
@section("title","菜品编辑")
@section("content")
    <form action="" method="post" class="form-group" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="goods_name" class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" name="goods_name" placeholder="名称" class="form-group" value="{{old('goods_name',$menu->goods_name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="rating" class="col-sm-2 control-label">评分</label>
            <div class="col-sm-10">
                <input type="text" name="rating" placeholder="评分" class="form-group" value="{{old('rating',$menu->rating)}}">
            </div>
        </div>
        <div class="form-group">
        <label for="goods_price" class="col-sm-2 control-label">价格</label>
        <div class="col-sm-10">
            <input type="text" name="goods_price" placeholder="价格" class="form-group" value="{{old('goods_price',$menu->goods_price)}}">
        </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <input type="text" name="description" placeholder="描述" class="form-group" value="{{old('description',$menu->description)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="month_sales" class="col-sm-2 control-label">月销量</label>
            <div class="col-sm-10">
                <input type="text" name="month_sales" placeholder="月销量" class="form-group" value="{{old('month_sales',$menu->month_sales)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="rating_count" class="col-sm-2 control-label">评分数量</label>
            <div class="col-sm-10">
                <input type="text" name="rating_count" placeholder="评分数量" class="form-group" value="{{old('rating_count',$menu->rating_count)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="tips" class="col-sm-2 control-label">提示信息</label>
            <div class="col-sm-10">
                <input type="text" name="tips" placeholder="提示信息" class="form-group" value="{{old('tips',$menu->tips)}}">
            </div>
        </div>
        <div class="form-group">
        <label for="satisfy_count" class="col-sm-2 control-label">满意度数量</label>
        <div class="col-sm-10">
            <input type="text" name="satisfy_count" placeholder="满意度数量" class="form-group" value="{{old('satisfy_count',$menu->satisfy_count)}}">
        </div>
        </div>
        <div class="form-group">
            <label for="satisfy_rate" class="col-sm-2 control-label">满意度评分</label>
            <div class="col-sm-10">
                <input type="text" name="satisfy_rate" placeholder="满意度评分" class="form-group" value="{{old('satisfy_rate',$menu->satisfy_rate)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="shop_id" class="col-sm-2 control-label">所属商家</label>
            <div class="col-sm-10">
                <select class="form-group" name="shop_id">
                    <option>请选择所属商家:</option>
                    @foreach($shops as $shop)
                        <option value="{{$shop->id}}"<?php if($shop->id===$menu->shop_id) echo "selected";?>>{{$shop->shop_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="category_id" class="col-sm-2 control-label">所属分类</label>
            <div class="col-sm-10">
                <select class="form-group" name="category_id">
                    <option>请选择所属分类:</option>
                    @foreach($cates as $cate)
                        <option value="{{$cate->id}}" <?php if($cate->id===$menu->category_id) echo "selected";?>>{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">LOGO</label>
            <div class="col-sm-10">
                <img src="/uploads/{{$menu->goods_logo}}" alt="" height="100">
                <input type="file" class="form-group" name="goods_logo">
            </div>
        </div>
        <div class="form-group">
            <label for="status" class="col-sm-2 control-label">状态</label>
            <div class="col-sm-10">
                <input type="radio" name="status" class="form-group" value=1 {{$menu->status==1?"checked":""}}>上架
                </label>
                <label>
                    <input type="radio" name="status" class="form-group" value=0 {{$menu->status==0?"checked":""}}>下架
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="编辑" class="btn btn-success">
            </div>
        </div>
    </form>
@endsection