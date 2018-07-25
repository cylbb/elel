@extends("layouts.shop.default")
@section("title","菜品分类编辑")
@section("content")
    <form action="" method="post" class="form-group" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" placeholder="名称" class="form-group" value="{{old('name',$cate->name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="type_accumulation" class="col-sm-2 control-label">菜品编号</label>
            <div class="col-sm-10">
                <input type="text" name="type_accumulation" placeholder="菜品编号" class="form-group" value="{{old('type_accumulation',$cate->type_accumulation)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <input type="text" name="description" placeholder="描述" class="form-group" value="{{old('description',$cate->description)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="is_selected" class="col-sm-2 control-label">是否默认分类</label>
            <div class="col-sm-10">
                <input type="radio" name="is_selected" class="form-group" value="1" {{$cate->is_selected==1?"checked":""}}>是
                </label>
                <label>
                    <input type="radio" name="is_selected" class="form-group" value="0" {{$cate->is_selected==0?"checked":""}}>否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="shop_id" class="col-sm-2 control-label">所属商家</label>
            <div class="col-sm-10">
                <select class="form-group" name="shop_id">
                    <option>请选择所属商家:</option>
                    @foreach($shops as $shop)
                        <option value="{{$shop->id}}"<?php if($shop->id===$cate->shop_id) echo "selected";?>>{{$shop->shop_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="提交" class="btn btn-success">
            </div>
        </div>
    </form>
@endsection