@extends("layouts.admin.default")
@section("title","抽奖活动列表")
@section("content")
    <a href="{{route('events.add')}}" class="btn btn-success">添加</a>
    <table class="table table-bordered">
        <tr>
         <th>ID</th>
         <th>名称</th>
         <th>详情</th>
         <th>报名开始时间</th>
         <th>报名结束时间</th>
         <th>开奖时间</th>
         <th>报名人数</th>
         <th>是否开奖</th>
         <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>{!! $event->content !!}</td>
                <td>{{date('Y-m-d h:i:s',$event->start_time)}}</td>
                <td>{{date('Y-m-d h:i:s',$event->end_time)}}</td>
                <td>{{date('Y-m-d h:i:s',$event->prize_time)}}</td>
                <td>{{$event->num}}</td>
                <td>
                    @if($event->is_prize==1&&date('Y-m-d h:i:s',$event->prize_date)==date('Y-m-d h:i:s',time()))
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                @endif
                <td>
                    @if(date('Y-m-d h:i:s',$event->start_time) < date('Y-m-d h:i:s',time()))
                    <a href="{{route('events.edit',$event)}}" class="btn btn-primary">编辑</a>
                    <a href="{{route('events.del',$event)}}" class="btn btn-danger">删除</a>
                        @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{$events->links()}}
@endsection
