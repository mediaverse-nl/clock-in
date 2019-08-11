<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=K2D" rel="stylesheet">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.4.0/fullcalendar.min.css"/>

    <link href="/css/sidebar.css" rel="stylesheet">

    <title>Hello, world!</title>

    @stack('css')

    <style>
        body{
            /*background: #FFFFFF !important;*/
            padding-top: 56px;
        }
        .navbar.navbar-expand-lg.fixed-top a{
            color: #FFFFFF;
        }
        .navbar.navbar-expand-lg.fixed-top{
            background-color: #3F51B5 !important;
        }

        .card{
            border-radius: 0px;
        }

        .fc-day-grid-container{
            height: auto !important;
        }
        #calendar {
            width: 600px;
            margin: 0 auto;
        }
        .fc-time-grid-container{
            height: 100% !important;
        }


        /*!* Remove that awful yellow color and border from today in Schedule *!*/
        /*.fc-state-highlight {*/
            /*opacity: 0;*/
            /*border: none;*/
        /*}*/

        /*!* Styling for each event from Schedule *!*/
        /*.fc-time-grid-event.fc-v-event.fc-event {*/
            /*border-radius: 4px;*/
            /*border: none;*/
            /*padding: 5px;*/
            /*opacity: .65;*/
            /*left: 5% !important;*/
            /*right: 5% !important;*/
        /*}*/

        /*!* Bolds the name of the event and inherits the font size *!*/
        /*.fc-event {*/
            /*font-size: inherit !important;*/
            /*font-weight: bold !important;*/
        /*}*/

        /*!* Remove the header border from Schedule *!*/
        /*.fc td, .fc th {*/
            /*border-style: none !important;*/
            /*border-width: 1px !important;*/
            /*padding: 0 !important;*/
            /*vertical-align: top !important;*/
        /*}*/

        /*!* Inherits background for each event from Schedule. *!*/
        /*.fc-event .fc-bg {*/
            /*z-index: 1 !important;*/
            /*background: inherit !important;*/
            /*opacity: .25 !important;*/
        /*}*/

        /*!* Normal font weight for the time in each event *!*/
        /*.fc-time-grid-event .fc-time {*/
            /*font-weight: normal !important;*/
        /*}*/

        /*!* Apply same opacity to all day events *!*/
        /*.fc-ltr .fc-h-event.fc-not-end, .fc-rtl .fc-h-event.fc-not-start {*/
            /*opacity: .65 !important;*/
            /*margin-left: 12px !important;*/
            /*padding: 5px !important;*/
        /*}*/

        /*!* Apply same opacity to all day events *!*/
        /*.fc-day-grid-event.fc-h-event.fc-event.fc-not-start.fc-end {*/
            /*opacity: .65 !important;*/
            /*margin-left: 12px !important;*/
            /*padding: 5px !important;*/
        /*}*/

        /*!* Material design button *!*/
        /*.fc-button {*/
            /*display: inline-block;*/
            /*position: relative;*/
            /*cursor: pointer;*/
            /*min-height: 36px;*/
            /*min-width: 88px;*/
            /*line-height: 36px;*/
            /*vertical-align: middle;*/
            /*-webkit-box-align: center;*/
            /*-webkit-align-items: center;*/
            /*align-items: center;*/
            /*text-align: center;*/
            /*border-radius: 2px;*/
            /*box-sizing: border-box;*/
            /*-webkit-user-select: none;*/
            /*-moz-user-select: none;*/
            /*-ms-user-select: none;*/
            /*user-select: none;*/
            /*outline: none;*/
            /*border: 0;*/
            /*padding: 0 6px;*/
            /*margin: 6px 8px;*/
            /*letter-spacing: .01em;*/
            /*background: transparent;*/
            /*color: currentColor;*/
            /*white-space: nowrap;*/
            /*text-transform: uppercase;*/
            /*font-weight: 500;*/
            /*font-size: 14px;*/
            /*font-style: inherit;*/
            /*font-variant: inherit;*/
            /*font-family: inherit;*/
            /*text-decoration: none;*/
            /*overflow: hidden;*/
            /*-webkit-transition: box-shadow .4s cubic-bezier(.25,.8,.25,1),background-color .4s cubic-bezier(.25,.8,.25,1);*/
            /*transition: box-shadow .4s cubic-bezier(.25,.8,.25,1),background-color .4s cubic-bezier(.25,.8,.25,1);*/
        /*}*/

        /*.fc-button:hover {*/
            /*background-color: rgba(158,158,158,0.2);*/
        /*}*/

        /*.fc-button:focus, .fc-button:hover {*/
            /*text-decoration: none;*/
        /*}*/

        /*!* The active button box is ugly so the active button will have the same appearance of the hover *!*/
        /*.fc-state-active {*/
            /*background-color: rgba(158,158,158,0.2);*/
        /*}*/

        /*!* Not raised button *!*/
        /*.fc-state-default {*/
            /*box-shadow: None;*/
        /*}*/
    </style>
</head>
<body>

    <!-- Navigation -->
    @include('app.components.top-menu')

    <div id="wrapper">
        <!-- Sidebar -->
        @include('app.components.sidebar-menu')
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            @yield('content')
        </div>
        <!-- /#page-content-wrapper -->

        {{--@include('app.components.bottom-menu')--}}

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    {{--<script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>--}}
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.4.0/fullcalendar.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

    @stack('js')
</body>
</html>