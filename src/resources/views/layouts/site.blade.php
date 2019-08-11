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
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/css/animsition.min.css">

    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.15/css/mdb.min.css" rel="stylesheet">--}}

    @stack('css')

    <style>
        body {
            padding-top: 54px;
            font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        @media (min-width: 992px) {
            body {
                padding-top: 56px;
            }
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-weight: 700;
        }

        footer.footer {
            padding-top: 3rem;
            /*padding-bottom: 4rem;*/
        }

        html {
            position: relative;
            min-height: 100%;
        }
        body {
            /* Margin bottom by footer height */
            margin-bottom: 150px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            /* Set the fixed height of the footer here */
            height: 180px;
            line-height: 20px; /* Vertically center the text there */
            background-color: #f5f5f5;
        }
    </style>

</head>
<body>

    @include('components.site.top-menu')

    <div class="animsition" >
        @yield('content')
    </div>

    @include('components.site.footer')

    <!-- Scripts -->
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.15/js/mdb.min.js"></script>    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    {{--http://git.blivesta.com/animsition/--}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/js/animsition.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".animsition").animsition({
                inClass: 'fade-in',
                outClass: 'fade-out-down-sm',
                inDuration: 1500,
                outDuration: 800,
                linkElement: '.animsition-link',
                // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
                loading: true,
                loadingParentElement: 'body', //animsition wrapper element
                loadingClass: 'animsition-loading',
                loadingInner: '', // e.g '<img src="loading.svg" />'
                timeout: false,
                timeoutCountdown: 2000,
                onLoadEvent: true,
                browser: [ 'animation-duration', '-webkit-animation-duration'],
                // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
                // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
                overlay : false,
                overlayClass : 'animsition-overlay-slide',
                overlayParentElement : 'body',
                transition: function(url){ window.location.href = url; }
            });
        });
    </script>

    @stack('js')
</body>
</html>