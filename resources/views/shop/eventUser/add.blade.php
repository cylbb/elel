@extends("layouts.shop.default")
@section("title","报名抽奖活动")
@section("content")
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">报名抽奖活动</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="event_id" class="col-sm-2 control-label">活动名称</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="event_id">
                            <option value="0">请选择活动</option>
                            @foreach($events as $event)
                                @if(date('Y-m-d h:i:s',$event->start_time) <= date('Y-m-d h:i:s',time())
                                    &&date('Y-m-d h:i:s',$event->end_time) >= date('Y-m-d h:i:s',time()))
                                    <option value="{{$event->id}}">{{$event->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">提交</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection