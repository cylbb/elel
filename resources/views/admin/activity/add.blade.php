@extends("layouts.admin.default")
@section("title","活动添加")
@section("content")
    <form action="" method="post" class="form-group" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">标题</label>
            <div class="col-sm-10">
                <input type="text" name="title" placeholder="标题" class="form-group" value="{{old('title')}}">
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label">活动详情</label>
            <div class="col-sm-10">
                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var ue = UE.getEditor('container');
                    ue.ready(function() {
                        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                    });
                </script>
                <!-- 编辑器容器 -->
                <script id="container" name="content" type="text/plain"></script>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">开始时间</label>
            <div class="col-sm-10">
                <input type="date" name="start_time" placeholder="开始时间" class="form-group" value="{{old('start_time')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">结束时间</label>
            <div class="col-sm-10">
                <input type="date" name="end_time" placeholder="结束时间" class="form-group" value="{{old('end_time')}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="添加" class="btn btn-success">
            </div>
        </div>
    </form>
@endsection