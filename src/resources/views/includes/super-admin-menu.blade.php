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

        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i>

                <span class="indicator text-{{Auth::user()->isClockedIn() ? 'success' : 'danger'}} d-none d-lg-block">
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
                    @if(!$loop->last)
                        <li class="divider"></li>
                    @else
                        <br />
                    @endif
                @endforeach
            </ul>
            <!-- /.dropdown-alerts -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="#"><i class="fa fa-cog fa-fw"></i> Change Password</a>
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
                <br>
                <li>
                    <h4 style="padding: 0px 15px;">super admin</h4>
                </li>
                <li class="">
                    <a href="{{route('super.dashboard')}}" class="{{\Request::is('super-admin') || \Request::is('super-admin/dashboard') ? 'active' : ''  }}">
                        <i class="fas fa-tachometer-alt fa-fw"></i>                        dashboard
                    </a>
                </li>
                <li class="">
                    <a href="{{route('super.business.index')}}" class="{{\Request::is('super-admin/business*') ? 'active' : ''  }}">
                        <i class="fa fa-building fa-fw"></i>
                        business
                    </a>
                </li>
                <li class="">
                    <a href="{{route('super.device.index')}}" class="{{\Request::is('super-admin/devices*') ? 'active' : ''  }}">
                        <i class="fas fa-tablet-alt"></i>
                        devices
                    </a>
                </li>
                <li class="">
                    <a href="{{route('super.firmware.index')}}" class="{{\Request::is('super-admin/firmware*') ? 'active' : ''  }}">
                        <i class="fas fa-code"></i>
                        firmware
                    </a>
                </li>

                <li class="">
                    <a href="{{route('clocked.index')}}" class="{{\Request::is('panel/clocked*') ? 'active' : ''  }}">
                        <i class="fa fa-user-clock fa-fw"></i>
                        tickets/reports
                    </a>
                </li>

                <li class="">
                    <a href="#">
                        <i class="fa fa-sitemap fa-fw"></i>
                        Business
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                        <li>
                            <a href="#">
                                <i class="fa fa-user-clock fa-fw"></i>
                                settings
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-user-clock fa-fw"></i>
                                packages
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-sitemap fa-fw"></i>
                                location
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-third-level collapse" aria-expanded="false" style="">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user-clock fa-fw"></i>
                                        whitelist
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user-clock fa-fw"></i>
                                        devices
                                    </a>
                                </li>
                            </ul>
                            <!-- /.nav-third-level -->
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
