<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        @auth
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>

            <div class="pull-left info">
                <p>欢迎</p>
                <a href="#"><i class="fa fa-circle text-success"></i>{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
            </div>
        </div>
    @endauth
        @guest
            <li><a href="{{route('user.login')}}">登录</a></li>
    @endguest
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>订单管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('order.total')}}"><i class="fa fa-circle-o"></i>订单展示</a></li>
                    <li class="active"><a href="{{route('order.index')}}"><i class="fa fa-circle-o"></i>订单列表</a></li>
                    <li class="active"><a href="{{route('order.day')}}"><i class="fa fa-circle-o"></i>订单每日统计表</a></li>
                    <li class="active"><a href="{{route('order.month')}}"><i class="fa fa-circle-o"></i>订单每月统计表</a></li>
                    <li class="active"><a href="{{route('order.goodDay')}}"><i class="fa fa-circle-o"></i>菜品每日统计表</a></li>
                    <li class="active"><a href="{{route('order.goodMonth')}}"><i class="fa fa-circle-o"></i>菜品每月统计表</a></li>
                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>--}}
                </ul>
                </ul>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>商家列表</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i> 商家信息列表</a></li>
                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>--}}
                </ul>
        </ul>
            </li>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>抽奖活动列表</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('event.index')}}"><i class="fa fa-circle-o"></i> 抽奖活动</a></li>
                    <li class="active"><a href="{{route('prize.index')}}"><i class="fa fa-circle-o"></i> 抽奖结果列表</a></li>
                    <li class="active"><a href="{{route('eventUser.index')}}"><i class="fa fa-circle-o"></i> 抽奖活动报名列表</a></li>
                </ul>
        </ul>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>活动管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('activity.index')}}"><i class="fa fa-circle-o"></i> 活动列表</a></li>
            <li>
                            {{--<li><a href="#"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>--}}
                        </ul>
                </ul>
            </li>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>商家商品列表</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('cate.index')}}"><i class="fa fa-circle-o"></i> 菜品分类列表</a></li>
                    <li class="active"><a href="{{route('menu.index')}}"><i class="fa fa-circle-o"></i> 菜品列表</a></li>
                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>--}}
                </ul>
        </ul>

            </span>
                </a>
            {{--</li>--}}
            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-folder"></i> <span></span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="/"><i class="fa fa-circle-o"></i> 注册</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-share"></i> <span>Multilevel</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>--}}
                    {{--<li class="treeview">--}}
                        {{--<a href="#"><i class="fa fa-circle-o"></i> Level One--}}
                            {{--<span class="pull-right-container">--}}
                  {{--<i class="fa fa-angle-left pull-right"></i>--}}
                {{--</span>--}}
                        {{--</a>--}}
                        {{--<ul class="treeview-menu">--}}
                            {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>--}}
                            {{--<li class="treeview">--}}
                                {{--<a href="#"><i class="fa fa-circle-o"></i> Level Two--}}
                                    {{--<span class="pull-right-container">--}}
                      {{--<i class="fa fa-angle-left pull-right"></i>--}}
                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<ul class="treeview-menu">--}}
                                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>--}}
                                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>--}}
            {{--<li class="header">LABELS</li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>--}}
        {{--</ul>--}}
    </section>
    <!-- /.sidebar -->
</aside>