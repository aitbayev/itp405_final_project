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

    <form method="post" action="/edit/countries" class="form-horizontal">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="text" name="country_name" placeholder="Country name">
        <select name="continent_id">
            @foreach($continents as $continent)
                <option value="{{$continent->continent_id}}">{{$continent->continent_name}}</option>
            @endforeach
        </select>
        <input type="submit" value="Add a new country" class="btn-success">
    </form>
    <table class="table table-striped">
        <thead>
        <tr>
            <th> ID </th>
            <th> Name </th>
            <th> Continent ID</th>
        </tr>
        </thead>

        <tbody>
        @foreach($countries as $country)
            <tr>
                <form method="post" action="/edit/countries/{{$country->country_id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <td><input type="text" name="id" value="{{$country->country_id}}" readonly></td>
                    <td><input type="text" name="name" value="{{$country->country_name}}"></td>
                    <td><input type="text" name="continent_id" value="{{$country->continent_id}}"></td>
                    <td><input type="submit" value="Update" class="button"></td>
                </form>
                <form method="post" action="/delete/countries/{{$country->country_id}}">
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