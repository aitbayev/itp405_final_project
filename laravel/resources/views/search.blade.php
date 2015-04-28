@extends('layout')

@section('footer')

@stop

@section('content')

    @if (Session::has('success'))
        <p> {{Session::get('success')}} </p>
    @endif

<form method="get" action="/places" class="form-horizontal">
    <div class="control-group">
        <label class="control-label">Continent</label>
            <div class="controls">
                <select name="continent" id="continent">
                     <option value="all"> All </option>
                        @foreach($continents as $continent)
                             <option value="{{ $continent->continent_id }}">{{ $continent->continent_name }}</option>
                        @endforeach
                </select>
            </div>
    </div>

    <div class="control-group">
        <label class="control-label">Country</label>
        <div class="controls">
            <select name="country" id="country">
                <option value="all"> All </option>
            </select>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
                <input type="submit" class="search" value="Search"/>
        </div>
    </div>
</form>

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
    @stop


