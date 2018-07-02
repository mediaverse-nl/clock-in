<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{!! route('dashboard') !!}">PUR v2.0</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right main-menu-default">
        {{--<li class="dropdown">--}}
            {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#">--}}
                {{--<i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>--}}
            {{--</a>--}}
            {{--<ul class="dropdown-menu dropdown-messages">--}}
                {{--<li>--}}
                    {{--<a href="#">--}}
                        {{--<div>--}}
                            {{--<strong>John Smith</strong>--}}
                            {{--<span class="pull-right text-muted">--}}
                                {{--<em>Yesterday</em>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                        {{--<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li>--}}
                    {{--<a class="text-center" href="#">--}}
                        {{--<strong>Read All Messages</strong>--}}
                        {{--<i class="fa fa-angle-right"></i>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
            {{--<!-- /.dropdown-messages -->--}}
        {{--</li>--}}

        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i>
                <span class="indicator text-warning d-none d-lg-block">
                  <i class="fa fa-fw fa-circle"></i>
                </span>
                <i class="fa fa-caret-down"></i>

            </a>
            <ul class="dropdown-menu dropdown-alerts" style="padding-top: 10px;">
                @foreach($notificationClocked as $clock)
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-stopwatch fa-fw"></i>
                                {{\Carbon\Carbon::parse($clock->started_at)->diffForHumans(\Carbon\Carbon::now(), true, true, 3)}}
                                <span class="pull-right text-muted small">{{$clock->diffInTime()}}</span>
                            </div>
                        </a>
                    </li>

                    <li class="divider"></li>
                @endforeach

                {{--<li>--}}
                    {{--<a class="text-center" href="#">--}}
                        {{--<strong>See All Alerts</strong>--}}
                        {{--<i class="fa fa-angle-right"></i>--}}
                    {{--</a>--}}
                {{--</li>--}}
            </ul>
            <!-- /.dropdown-alerts -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                {{--<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>--}}
                {{--</li>--}}
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt fa-fw"></i>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar bar-menu" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav in" id="side-menu">
                <li>
                    <a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt fa-fw"></i> Dashboard </a>
                </li>
                <li>
                    <a href="{{route('auth.dashboard')}}"><i class="fa fa-chart-line fa-fw"></i> Mijn Dashboard </a>
                </li>
                <li>
                    <a href="{{route('card.index')}}"><i class="fa fa-id-card fa-fw"></i> Card</a>
                </li>
                <li>
                    <a href="{{route('user.index')}}"><i class="fa fa-users fa-fw"></i> Users</a>
                </li>
                <li class="disabled">
                    <a href="#"><i class="fa fa-hand-holding-usd fa-fw"></i> Payroll</a>
                </li>
                <li class="">
                    <a href="{{route('clocked.index')}}"><i class="fa fa-user-clock fa-fw"></i> clocked</a>
                </li>
                <li class="">
                    <a href="{{route('calendar.index')}}"><i class="fa fa-calendar-alt fa-fw"></i> Calendar</a>
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
