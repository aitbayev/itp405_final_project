@extends('layout')

@section('footer')

@stop

@section('content')
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
                        <a href="/search#search">Search</a>
                    </li>
                    <li>
                        <a href="/search#login">Login</a>
                    </li>
                    <li>
                        <a href="/search#signup">Signup</a>
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
    <div class="results">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">

                        <table class="table">
                            <thead>
                            <tr>
                                <th> Continent</th>
                                <th> Country</th>
                                <th> City</th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach($places as $place)
                                <tr>
                                    <td> {{ $place->continent_name }} </td>
                                    <td> {{ $place->country_name }} </td>
                                    <td> <a href="/places/{{$place->id }}">{{ $place->city_name }}</a> </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>


@stop