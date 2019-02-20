<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    {{--https://coreui.io/docs/components/bootstrap-navs/--}}
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


    {{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">--}}
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    @stack('css')

    <style>
        body{
            background: #FFFFFF !important;
            padding-top: 50px;
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
        .navbar.navbar-default.navbar-fixed-top{
            background-color: #3F51B5 !important;
            border: none !important;
            box-shadow: 0 1px 8px rgba(0,0,0,.3);
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


    </style>

</head>
<body class="app">

    <div id="wrapper">

        @if (!Auth::guest())
            <!-- Navigation -->
            @include('components.menu-main')

            <!-- Page Content -->
            <div id="page-wrapper" style="min-height: 419px; padding-top: 25px;">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        @else
            @yield('content')
        @endif

    <!-- /#page-wrapper -->
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.8/metisMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/3.3.7/js/sb-admin-2.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang/nl.js"></script>

    @stack('js')
</body>
</html>