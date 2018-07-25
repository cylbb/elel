@extends("layouts.shop.default")
@section("title","活动列表")
@section("content")
    <table class="table table-bordered">
        <tr>
            <th>活动内容</th>
        </tr>
        <tr>
            <td>{!! $activity->content !!}</td>
        </tr>
    </table>
    @endsection