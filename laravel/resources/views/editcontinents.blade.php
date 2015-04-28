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

    <form method="post" action="/edit/continents" class="form-horizontal">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="table" value="continents">
     <input type="text" name="continent_name" placeholder="Continent name">
        <input type="submit" value="Add a new continent" class="btn-success">
        </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th> ID </th>
                <th> Name </th>
            </tr>
        </thead>

        <tbody>
             @foreach($continents as $continent)
                 <tr>
                     <form method="post" action="/edit/continents/{{$continent->continent_id}}">
                         <input type="hidden" name="_token" value="{{csrf_token()}}">
                         <td><input type="text" name="id" value="{{$continent->continent_id}}" readonly></td>
                         <td><input type="text" name="name" value="{{$continent->continent_name}}"></td>
                         <td><input type="submit" value="Update" class="button"></td>
                     </form>
                     <form method="post" action="/delete/continents/{{$continent->continent_id}}">
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