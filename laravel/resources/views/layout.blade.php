<!DOCTYPE html>
<html lang="en">
<head>
    <title>Travel search</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" media="screen">

    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="{{ asset('css/landing-page.css') }}" rel="stylesheet" media="screen">

    <script src="{{ asset('js/jquery.js') }}"></script>

    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{asset('js/lightbox.min.js')}}"></script>
    <link href="{{asset('css/lightbox.css')}}" rel="stylesheet" />

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</head>
<body>

<div class="container">
    <div class="header">
        {{--<div id="myCarousel" class="carousel slide" >--}}
            {{--<ol class="carousel-indicators">--}}
                {{--<li data-target="#myCarousel" data-slide-to="0" class="active"></li>--}}
                {{--<li data-target="#myCarousel" data-slide-to="1"></li>--}}
                {{--<li data-target="#myCarousel" data-slide-to="2"></li>--}}
            {{--</ol>--}}
            {{--<!-- Carousel items -->--}}
            {{--<div class="carousel-inner">--}}
                {{--<div class="active item"><img src="{{ asset('img/rome.jpg') }}"></div>--}}
                {{--<div class="item"> <img src="{{ asset('img/rome.jpg') }}"></div>--}}
                {{--<div class="item"> <img src="{{ asset('img/rome.jpg') }}"></div>--}}
            {{--</div>--}}
            {{--<!-- Carousel nav -->--}}
            {{--<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>--}}
            {{--<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>--}}
        {{--</div>--}}
        </div>
    @yield('content')
</div>

</body>
</html>