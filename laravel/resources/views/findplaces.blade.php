@extends('layout')

@section('footer')

@stop

@section('content')
<form method="get" action = "/places">
    Select continent:
    <select name="continent" onchange="check()" id="continent">
        <option value="all">All </option>
        @foreach($continents as $continent)
             <option value="{{ $continent->continent_id }}"> {{$continent->continent_name}} </option>
        @endforeach
    </select>
    <br/>
    {{--Select country:--}}
    {{--<select name="country"  id="country">--}}
        {{--<option value="all">All </option>--}}
        {{--@foreach($countries as $country)--}}
            {{--<option value="{{ $country->country_id}}"> {{$country->country_name}} </option>--}}
        {{--@endforeach--}}
    {{--</select>--}}
    <input type="submit">
</form>

<script>
    function check(){
        var a = document.getElementById('continent').value;

    }

    </script>

@stop