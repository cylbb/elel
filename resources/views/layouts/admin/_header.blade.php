<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route('admin.index')}}">首页 <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('shop_category.index')}}">商家分类管理</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('shop.index')}}">商家信息表</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('activitys.index')}}">活动列表</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理员管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admin.index')}}">管理员列表</a></li>
                    </ul>
                </li>
                <li><a href="/">关于我们</a></li>

                <li><a href="/">帮助</a></li>

            </ul>
            <form class="navbar-form navbar-left" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="search">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @auth('admin')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('admin.logout')}}">注销</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('admin.update')}}">修改个人密码</a></li>
                        </ul>
                    </li>
                @endauth

                @guest('admin')
                        <li><a href="{{route('admin.login')}}">登录</a></li>
                @endguest


            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>