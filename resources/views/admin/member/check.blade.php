@extends('layouts.admin.default')
@section('title','充值')
@section('content')
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="money" class="col-sm-2 control-label">充值金额</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('money')}}" class="form-group" placeholder="请输入金额"
                       name="money">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交<tton>
            </div>
        </div>
    </form>

@endsection