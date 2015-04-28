@extends('layout')
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

<form method="post" action="/edit/places" class="form-horizontal">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <select name="continent_id">
        <option selected="1" disabled> Continent</option>
        @foreach($continents as $continent)
                <option value="{{$continent->continent_id}}">{{$continent->continent_name}}</option>
        @endforeach
    </select>
    <select name="country_id">
        <option selected="1" disabled> Country</option>
        @foreach($countries as $country)
            <option value="{{$country->country_id}}">{{$country->country_name}}</option>
        @endforeach
    </select>
    <select name="city_id">
        <option selected="1" disabled> City</option>
        @foreach($cities as $city)
            <option value="{{$city->city_id}}">{{$city->city_name}}</option>
        @endforeach
    </select>
    <select name="price_id">
        <option selected="1" disabled> Price</option>
        @foreach($prices as $price)
            <option value="{{$price->price_id}}">{{$price->price_name}}</option>
        @endforeach
    </select>
    <textarea name="description" placeholder="information">

        </textarea>

    <input type="submit" value="Add a new place" class="btn-success">
</form>
<table class="table table-striped">
    <thead>
    <tr>
        <th> ID </th>
        <th> Continent </th>
        <th> Country </th>
        <th> City </th>
        <th> Price </th>
        <th> Information </th>
    </tr>
    </thead>

    <tbody>
    @foreach($places as $place)
    <tr>
        <form method="post" action="/edit/places/{{$place->id}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <td><input type="text" name="id" value="{{$place->id}}" readonly></td>
            <td>
                <select name="continent_id">
                @foreach($continents as $continent)
                    @if($continent->continent_id == $place->continent_id)
                        <option selected="1" value="{{$continent->continent_id}}">{{$continent->continent_name}}</option>
                    @else
                    <option value="{{$continent->continent_id}}">{{$continent->continent_name}}</option>
                        @endif
                    @endforeach
                </select>
            </td>
            <td>
                <select name="country_id">
                    @foreach($countries as $country)
                        @if($country->country_id == $place->country_id)
                            <option selected="1" value="{{$country->country_id}}">{{$country->country_name}}</option>
                        @else
                            <option value="{{$country->country_id}}">{{$country->country_name}}</option>
                        @endif
                    @endforeach
                </select>
            </td>
            <td>
                <select name="city_id">
                    @foreach($cities as $city)
                        @if($city->city_id == $place->city_id)
                            <option selected="1" value="{{$city->city_id}}">{{$city->city_name}}</option>
                        @else
                            <option value="{{$city->city_id}}">{{$city->city_name}}</option>
                        @endif
                    @endforeach
                </select>
            </td>
            <td>
                <select name="price_id">
                    @foreach($prices as $price)
                        @if($price->price_id == $place->price_id)
                            <option selected="1" value="{{$price->price_id}}">{{$price->price_name}}</option>
                        @else
                            <option value="{{$price->price_id}}">{{$price->price_name}}</option>
                        @endif
                    @endforeach
                </select>
            </td>
            <td>
                <textarea name="description"> {{$place->description}} </textarea>
            </td>

            <td><input type="submit" value="Update" class="button"></td>
        </form>
        <form method="post" action="/delete/places/{{$place->id}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <td><input type="submit" value="Delete" class="alert-danger" ></td>
        </form>
    </tr>
    @endforeach
    </tbody>
    @endif
    @else
        <p> Access denied </p>
    @endif
</table>
