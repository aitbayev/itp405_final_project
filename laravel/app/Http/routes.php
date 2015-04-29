<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('search','PlacesController@firstMethod');

Route::get('/places', 'PlacesController@searchResult');

Route::get('edit', 'PlacesController@edit');

//contients
Route::get('edit/continents', 'PlacesController@editContinents');
Route::post('edit/continents/{id}', 'PlacesController@updateContinents');
Route::post('edit/continents', 'PlacesController@addContinent');
Route::post('delete/continents/{id}', 'PlacesController@deleteContinent');
//countries
Route::get('edit/countries', 'PlacesController@editCountries');
Route::post('edit/countries/{id}', 'PlacesController@updateCountries');
Route::post('edit/countries', 'PlacesController@addCountry');
Route::post('delete/countries/{id}', 'PlacesController@deleteCountry');
//cities
Route::get('edit/cities', 'PlacesController@editCities');
Route::post('edit/cities/{id}', 'PlacesController@updateCities');
Route::post('edit/cities', 'PlacesController@addCity');
Route::post('delete/cities/{id}', 'PlacesController@deleteCity');
//places
Route::get('edit/places', 'PlacesController@editPlaces');
Route::post('edit/places/{id}', 'PlacesController@updatePlaces');
Route::post('edit/places', 'PlacesController@addPlace');
Route::post('delete/places/{id}', 'PlacesController@deletePlace');
//details

Route::get('/places/{id}', 'PlacesController@placeDetails');
Route::post('places/{id}', 'PlacesController@addReview');


Route::get('loadcountry/{id}','PlacesController@secondMethod');
Route::get('loadcountry', 'PlacesController@thirdMethod');

Route::get('signup', 'UsersController@createUser');
Route::post('signup', 'UsersController@saveUser');

Route::get('login', 'UsersController@login');
Route::post('login', 'UsersController@loginUser');

Route::get('logout', 'UsersController@logout');





