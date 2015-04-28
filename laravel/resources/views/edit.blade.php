@extends('layout')

@section('footer')

@stop

@section('content')
    @if(Auth::check())
        @if (Auth::user()->email == 'dtang@usc.edu')
            <div style="float: right;">
               <a href="/logout"> [LOGOUT]</a>
                </div>
    <h2> Tables to edit:</h2>
    <a href="edit/continents"> Continents</a>
    <br/>
    <a href="edit/countries"> Countries</a>
    <br/>
    <a href="edit/cities"> Cities</a>
    <br/>
    <a href="edit/places"> Places</a>
        @endif
        @else
        <p> Access denied </p>
    @endif
@stop