<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Travel search</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" media="screen">

    <!-- Custom CSS -->
    <link href="{{ asset('css/landing-page.css') }}" rel="stylesheet" media="screen">

    <!-- Custom Fonts -->
    <link href="{{ asset('font-awesome/css/landing-page.css') }}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">



</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
    <div class="container topnav">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    @if(Auth::check())
                        <a href="/logout">Logout, {{Auth::user()->name}}</a>
                    @endif
                </li>
                </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#search">Search</a>
                </li>
                <li>
                    <a href="#login">Login</a>
                </li>
                <li>
                    <a href="#signup">Signup</a>
                </li>
                @if(Auth::check())
                    @if(Auth::user()->email=='dtang@usc.edu')
                    <li>
                        <a href="/edit" style="color: red;">Admin</a>
                    </li>
                        @endif
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


<!-- Header -->
<a name="search"></a>
<div class="intro-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message">
                    <h1>Travel Guide</h1>
                    <hr class="intro-divider">

                    <form method="get" action="/places" >
                        <div class="control-group">
                            <label class="control-label">Continent</label>
                            <div class="controls">
                                <select name="continent" id="continent" class="form-control" >
                                    <option value="all"> All </option>
                                    @foreach($continents as $continent)
                                        <option value="{{ $continent->continent_id                                                                   }}">{{ $continent->continent_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Country</label>
                            <div class="controls">
                                <select name="country" id="country" class="form-control">
                                    <option value="all"> All </option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <div class="control-group">
                            <div class="controls">
                                <input type="submit" class="btn btn-default btn-lg"                                                         value="Search"/>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.intro-header -->

<!-- Page Content -->

<a  name="login"></a>
<div class="banner1">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-6">
                <h1>Login</h1>
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                @if (Session::has('success'))
                    <p> {{Session::get('success')}} </p>
                @endif

                @if (Session::has('error'))
                    <p> {{Session::get('error')}} </p>
                @endif

                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
                <form method="post" action="login">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember_me">
                            Remember Me
                        </label>
                    </div>

                    <input type="submit" value="Login" class="btn btn-primary">
                </form>
            </div>

        </div>
        <!-- /.container -->

    </div>

</div>
<a  name="signup"></a>
<div class="banner">
    <div class="container">
        <div class="row">
            <h1>Signup</h1>
            <hr class="section-heading-spacer">
            <div class="clearfix"></div>

            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
            <form method="post" action="signup">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"                                 class="form-control">
                </div>

                <input type="submit" value="Sign Up" class="btn btn-primary">
            </form>
        </div>

    </div>
    <!-- /.container -->

</div>

<!-- jQuery -->
<script src="{{ asset('js/jquery.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $(window).load(function(){

            $.get('loadcountry/', function(data) {
                        $('#country').html(data);
                    }
            );
        })
        $('#continent').change(function() {
                    if ($(this).val()=='all'){
                        $.get('loadcountry/', function(data) {
                                    $('#country').html(data);
                                }
                        );
                    }
                    else {
                        $.get('loadcountry/' + $(this).val(), function(data) {
                                    $('#country').html(data);
                                }
                        );
                    }}
        );


    });

</script>
</body>

</html>
