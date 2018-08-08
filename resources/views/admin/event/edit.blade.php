@extends("layouts.admin.default")
@section("title","抽奖活动编辑")
@section("content")
    <form action="" method="post" class="form-group" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" name="title" placeholder="名称" class="form-group" value="{{old('title',$event->title)}}">
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
                <script id="container" name="content" type="text/plain">{!!$event->content!!}</script>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">开始时间</label>
            <div class="col-sm-10">
                <input type="date" name="start_time" placeholder="开始时间" class="form-group" value="{{old('start',date('Y-m-d',$event->start_time))}}">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">结束时间</label>
            <div class="col-sm-10">
                <input type="date" name="end_time" placeholder="结束时间" class="form-group" value="{{old('start',date('Y-m-d',$event->end_time))}}">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">开奖时间</label>
            <div class="col-sm-10">
                <input type="date" name="prize_time" placeholder="开奖时间" class="form-group" value="{{old('start',date('Y-m-d',$event->prize_time))}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="编辑" class="btn btn-success">
            </div>
        </div>
    </form>
@endsection