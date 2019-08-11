<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        body {
            font: normal 16px/26px Arial, sans-serif;
            background: #3F51B5;
            color: #ffffff;
        }

        .error-page {
            margin: 100px 0 40px;
            text-align: center;
        }

        .error-page__header-image {
            width: 112px;
        }

        .error-page__title {
            font-family: "Roboto", Arial, sans-serif;
            font-size: 31px;
        }
    </style>
</head>
<body>
    {{--<h1>Hello, world!</h1>--}}
    <div class="error-page">
        <header class="error-page__header">
            <img class="error-page__header-image" src="https://static.tutsplus.com/assets/sad-computer-128aac0432b34e270a8d528fb9e3970b.gif" alt="Sad computer">
            <h1 class="nolinks">Error (404)</h1>
            <h1 class="error-page__title nolinks">Page Not Found</h1>
        </header>
        <p class="error-page__message">The page you are looking for could not be found.</p>
        <a href="{!! url(env('APP_URL')) !!}" class="btn btn-primary">a</a>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>



