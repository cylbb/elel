@extends("layouts.admin.default")
@section('title','会员显示页面')
@section('content')
    <form class="form-inline" action="" method="get">
        <div class="form-group navbar-right col-lg-3" >
            <input type="text" class="form-control" name="search" placeholder="搜索">
            <button type="submit" class="btn btn-default">搜索</button>
        </div>
        <div class="form-group">
        </div>
    </form>
    {{--<a href="{{route('shop_info.add')}}" class="btn btn-info">添加</a>--}}
    <table class="table table-bordered">
            <th>id</th>
            <th>会员名称</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td>{{$member->username}}</td>


                <td>
                    <a href="{{route('member.info',$member->id)}}" class=" btn btn-success">查看详情</a>
                    <a href="{{route('member.check',$member->id)}}" class="btn btn-primary">充值</a>
                </td>

            </tr>
        @endforeach
    </table>
    {{$members->appends($query)->links()}}
@endsection