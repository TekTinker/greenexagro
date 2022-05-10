<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Greenex Agro Chemicals</title>

    <style>
        /* Paste this css to your style sheet file or under head tag */
        /* This only works with JavaScript,
        if it's not present, don't show loader */
        .no-js #loader {
            display: none;
        }

        .js #loader {
            display: block;
            position: absolute;
            left: 100px;
            top: 0;
        }

        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('{{  URL::asset('images/logo/loader.gif') }}') center no-repeat #fff;
        }

        #main-body {
            display: none;
        }
    </style>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('images/logo/favi.png') }}">

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('template/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{  URL::asset('template/css/font-awesome.min.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{  URL::asset('template/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('template/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('template/sidebarstyles.css') }}">
    <link rel="stylesheet" href="{{  URL::asset('template/css/responsive.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <script src="{{  URL::asset('template/js/jquery.min.js') }}"></script>


    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({selector: '.tinymce'});</script>


    <script type="text/javascript">
        $(window).load(function () {
            // Animate loader off screen
            $(".se-pre-con").fadeOut(700);
            $("#main-body").fadeIn(2000);

        })
    </script>

</head>
<body>
<div class="se-pre-con"></div>


@include('partials.header')
@include('partials.logo')
@include('partials.navigation')

<div id="main-body">

    @yield('base')


</div>

@include('partials.footer')


<!-- Latest jQuery form server -->

<!-- Bootstrap JS form CDN -->

<script src="{{  URL::asset('template/js/bootstrap.min.js') }}"></script>


<!-- jQuery sticky menu -->
<script src="{{  URL::asset('template/js/owl.carousel.min.js') }}"></script>
<script src="{{  URL::asset('template/js/jquery.sticky.js') }}"></script>

<!-- jQuery easing -->
<script src="{{  URL::asset('template/js/jquery.easing.1.3.min.js') }}"></script>

<!-- Main Script -->
<script src="{{  URL::asset('template/js/main.js') }}"></script>

<!-- Sidebar Script -->
<script src="{{  URL::asset('template/js/sidebarscript.js') }}"></script>

<!-- Slider -->
<script type="text/javascript" src="{{  URL::asset('template/js/bxslider.min.js') }}"></script>
<script type="text/javascript" src="{{  URL::asset('template/js/script.slider.js') }}"></script>

</body>
</html>