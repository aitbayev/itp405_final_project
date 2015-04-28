@extends('layout')
@section('footer')

@stop
@section('content')
    @if(Auth::check())
        @if (Auth::user()->email == 'dtang@usc.edu')
            <div style="float: right;">
                <a href="/logout"> [LOGOUT]</a>
            </div>
            <a href="/edit"> [BACK TO ALL TABLES] <a/>
    @foreach($errors->all() as $error)
        <p style="color:red">{{$error}}</p>
    @endforeach

    @if (Session::has('success'))
        <p style="color: green;"> {{Session::get('success')}} </p>
    @endif

    <form method="post" action="/edit/cities" class="form-horizontal">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="text" name="city_name" placeholder="City name">
        <input type="submit" value="Add a new city" class="btn-success">
    </form>
    <table class="table table-striped">
        <thead>
        <tr>
            <th> ID </th>
            <th> Name </th>
        </tr>
        </thead>

        <tbody>
        @foreach($cities as $city)
            <tr>
                <form method="post" action="/edit/cities/{{$city->city_id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <td><input type="text" name="id" value="{{$city->city_id}}" readonly></td>
                    <td><input type="text" name="name" value="{{$city->city_name}}"></td>
                    <td><input type="submit" value="Update" class="button"></td>
                </form>
                <form method="post" action="/delete/cities/{{$city->city_id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <td><input type="submit" value="Delete" class="alert-danger" ></td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
        @endif
    @else
        <p> Access denied </p>
    @endif
@stop