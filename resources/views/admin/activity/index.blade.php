@extends("layouts.admin.default")
@section("title","活动列表")
@section("content")
    <a href="{{route('activity.add')}}" class="btn btn-success">添加</a>
    <a href="{{route('activitys.index')}}" class="btn btn-primary">全部</a>
    <a href="{{route('activity.unStart')}}" class="btn btn-info">未开始</a>
    <a href="{{route('activity.going')}}" class="btn btn-adn">进行中</a>
    <a href="{{route('activity.over')}}" class="btn btn-danger">已结束</a>
    <table class="table table-bordered">
        <tr>
         <th>ID</th>
         <th>标题</th>
         <th>内容</th>
         <th>开始时间</th>
         <th>结束时间</th>
         <th>操作</th>
        </tr>
        @foreach($activites as $activite)
            <tr>
                <td>{{$activite->id}}</td>
                <td>{{$activite->title}}</td>
                <td>{!! $activite->content !!}</td>
                <td>{{$activite->start_time}}</td>
                <td>{{$activite->end_time}}</td>
                <td>
                    <a href="{{route('activity.edit',$activite)}}" class="btn btn-primary">编辑</a>
                    <a href="{{route('activity.del',$activite)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$activites->links()}}
@endsection
