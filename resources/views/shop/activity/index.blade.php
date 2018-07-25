@extends("layouts.shop.default")
@section("title","活动列表")
@section("content")
    <a href="{{route('activity.add')}}" class="btn btn-success">添加</a>
    <table class="table table-bordered">
        <tr>
         <th>ID</th>
         <th>标题</th>
         <th>开始时间</th>
         <th>结束时间</th>
         <th>查看</th>
        </tr>
        @foreach($activitys as $activite)
            <tr>
                <td>{{$activite->id}}</td>
                <td>{{$activite->title}}</td>
                <td>{{$activite->start_time}}</td>
                <td>{{$activite->end_time}}</td>
                <td>
                    <a href="{{route('activity.show',$activite)}}" class="btn btn-primary">活动详情</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$activitys->links()}}
@endsection
