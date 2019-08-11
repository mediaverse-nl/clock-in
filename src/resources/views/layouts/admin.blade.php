<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/3.3.7/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.8/metisMenu.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    @stack('css')

    <style>
        body{
            background: #FFFFFF !important;
            /*padding-top: 50px;*/
        }
        .navbar-brand{ color: #FFFFFF !important;}
        .main-menu-default > li,
        .main-menu-default a{
            color: #FFFFFF !important;
        }
        .main-menu-default .dropdown-toggle:hover,
        .main-menu-default > .dropdown.open a,
        .main-menu-default > .dropdown li{
            color: #333 !important;
        }
        .navbar-default .sidebar a,
        .navbar-default .sidebar li{
            color: #333 !important;
        }
        .navbar.navbar-inverse{
            background-color: #3F51B5 !important;
            border: none !important;
            box-shadow: 0 1px 8px rgba(0,0,0,.3);
            border-radius: 0px;
        }
        .bar-menu{
            background: #FFFFFF !important;
        }
        .bar-menu a{
            color: #333333 !important;
        }
        #page-wrapper{
            background-color: #FAFAFA;
        }

        /*panel*/
        .panel{
            border-radius: 0px !important;
            box-shadow: 0 3px 1px -2px rgba(0,0,0,.02), 0 2px 2px 0 rgba(0,0,0,.04), 0 1px 5px 0 rgba(0,0,0,.02);
            /*transition: box-shadow 280ms cubic-bezier(.4,0,.2,1);*/
            border-radius: 2px;
        }
        .panel > .panel-heading{
            background-color: #FFFFFF;
            padding: 15px;
        }

        /*default*/
        .btn{
            border-radius: 0px;
        }
        .btn-group{
            border-radius: 0px;
        }
        .btn.active,
        .btn:active {
            box-shadow: none !important;
        }

        hr{
            border-bottom: 1px solid #dddddd;
            border-top: 0px;
            clear:both;
            display:block;
            width: 100%;
            margin-top: 20px;
            /*padding: 10px 0px;*/
         }

    </style>

</head>
<body class=" ">

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">WebSiteName</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="{!! \Request::is('admin') ? 'active' : '' !!}"><a href="{!! route('admin.dashboard') !!}">Dashboard</a></li>
                <li class="{!! \Request::is('admin/rooster*') ? 'active' : '' !!}"><a href="{!! route('admin.schedule.week') !!}">Rooster</a></li>
                <li class="{!! \Request::is('admin/tijdregistratie*') ? 'active' : '' !!}"><a href="{!! route('admin.time-tracking.index') !!}">Prikklok</a></li>
                <li class="{!! \Request::is('admin/team*') ? 'active' : '' !!}"><a href="{!! route('admin.team.index') !!}">Team</a></li>
                <li class="{!! \Request::is('admin/report*') ? 'active' : '' !!}"><a href="{!! route('admin.report.index') !!}">Reports</a></li>
                <li class="{!! \Request::is('admin/settings*') ? 'active' : '' !!}"><a href="{!! route('admin.settings.index') !!}">Settings</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <div class="form-group">
                         {{--<select class="form-control" id="sel1">--}}
{{--                            @foreach($menuUserLocations as $i)--}}
                                {{--<option>{!! $i !!}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    </div>
                </li>
                {{--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>--}}
                <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Uitloggen</a></li>
            </ul>
        </div>
    </nav>

    <!-- Page Content -->
     <div class="container-fluid">
         <div class="row">
            @yield('content')
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.8/metisMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/3.3.7/js/sb-admin-2.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang/nl.js"></script>

    <script>

        $('.action').click(function(){
            var editaction=($(this).attr("id"));

            console.log(editaction);
            $.ajax({
                type:"POST",
                url:"{!! route('admin.location.change') !!}",
                data:"location_id="+editaction,
                success:function(results){
                    // window.location.href="REDIRECTED ROUTE URL"
                }
            });
        });

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    @stack('js')
</body>
</html>