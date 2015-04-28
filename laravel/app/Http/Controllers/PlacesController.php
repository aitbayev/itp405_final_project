<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use App\Models\Continent;
use App\Models\Place;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use DB;

class PlacesController extends Controller{

    public function findPlace(){

        $query = new Place();
        $continents = $query->getContinents();
        $countries  = $query->getCountries();
        $cities = $query->getCities();

        return view('findplaces', [
            'continents' => $continents,
            'countries' => $countries,
            'cities' => $cities
        ]);
    }

    public function searchResult(Request $request){
        $continent_id = $request->input('continent');
        $country_id = $request->input('country');
        $places = Place::getSearchResult($continent_id, $country_id);

        return view('searchresult',
               ['places'=>$places
            ]);
    }

    public function firstMethod(){
        $query = new Place();
        $continents = $query->getContinents();
        return View::make('main',['continents' => $continents]);
    }

    public function secondMethod($id){
        $query = new Place();
        $countries = $query->getCountriesWithContinentId($id);
        return View::make('thisview', ['countries' => $countries]);
    }

    public function thirdMethod(){
        $query = new Place();
        $countries  = $query->getCountries();
        return View::make('thisview', ['countries' =>$countries]);
    }

    public function addReview(Request $request){
        $validation = Place::validate($request->all());

        if ($validation->passes()) {
            Place::addReview($request->input('place_id'), $request->input('user_id'), $request->input('review'));
            return redirect('places/'.$request->input('place_id'))->with('success', 'Your review was successfully added');
            }
        return redirect('places/'.$request->input('place_id'))->withErrors($validation->errors());
    }

    public function edit(){
        return view('edit');
    }

    public function editContinents(){
        $query = new Place();
        $continents = $query->getContinents();
        return view('editcontinents', [
            'continents' => $continents
        ]);
    }

    public function editCountries(){
        $query = new Place();
        $countries = $query->getCountries();
        $continents = $query->getContinents();
        return view('editcountries', [
            'countries' => $countries,
            'continents' => $continents
        ]);
    }

    public function editCities(){
        $query = new Place();
        $cities = $query->getCities();
        return view('editcities', [
            'cities' => $cities
        ]);
    }

    public function editPlaces(){
        $query = new Place();
        $places = $query->getAllPlaces();
        $continents = $query->getContinents();
        $countries = $query->getCountries();
        $cities = $query->getCities();
        $prices = $query->getPrices();
        return view('editplaces', [
            'places' => $places,
            'continents' => $continents,
            'countries' =>$countries,
            'cities' => $cities,
            'prices' => $prices
        ]);
    }

    public function updateContinents(Request $request){
        $validation = Place::validateIdName($request->all());
        if ($validation->passes()){
            Place::updateContinentWithId($request->input('id'),$request->input('name'));

            return redirect('edit/continents')->with('success', 'Continent information was successfully updated');
        }
        return redirect('edit/continents')->withErrors($validation->errors());
    }

    public function updateCountries(Request $request){
        $validation = Place::validateIdNameCont($request->all());
        if ($validation->passes()){
            Place::updateCountryWithId($request->input('id'),$request->input('name'), $request->input('continent_id'));
            return redirect('edit/countries')->with('success', 'Country information was successfully updated');
        }
        return redirect('edit/countries')->withErrors($validation->errors());
    }

    public function updateCities(Request $request){
        $validation = Place::validateIdName($request->all());
        if ($validation->passes()){
            Place::updateCityWithId($request->input('id'),$request->input('name'));
            return redirect('edit/cities')->with('success', 'City information was successfully updated');
        }
        return redirect('edit/cities')->withErrors($validation->errors());
    }

    public function updatePlaces(Request $request){
        $validation = Place::validatePlace($request->all());
        if($validation->passes()) {
            Place::updatePlaceWithId($request->input('id'), $request->input('continent_id'),
                $request->input('country_id'), $request->input('city_id'),
                $request->input('price_id'), $request->input('description'));
            return redirect('edit/places')->with('success', 'Place information was successfully updated');
        }
        return redirect('edit/places')->withErrors($validation->errors());
    }
    public function addContinent(Request $request){
        $validation = Place::validateName($request->all());
        if($validation->passes()){
            Place::addNewContinent($request->input('continent_name'));
            return redirect('edit/continents')->with('success', 'New continent was successfully added');
        }
        return redirect('edit/continents')->withErrors($validation->errors());
    }

    public function addCountry(Request $request){
        $validation = Place::validateCountry($request->all());
        if($validation->passes()){
            Place::addNewCountry($request->input('country_name'), $request->input('continent_id'));
            return redirect('edit/countries')->with('success', 'New country was successfully added');
        }
        return redirect('edit/countries')->withErrors($validation->errors());
    }

    public function addCity(Request $request){
        $validation = Place::validateCity($request->all());
        if($validation->passes()){
            Place::addNewCity($request->input('city_name'));
            return redirect('edit/cities')->with('success', 'New city was successfully added');
        }
        return redirect('edit/cities')->withErrors($validation->errors());
    }

    public function addPlace(Request $request){
        $validation = Place::validatePlace($request->all());
        if ($validation->passes()){
            Place::addNewPlace($request->input('continent_id'), $request->input('country_id'), $request->input('city_id'),
                $request->input('price_id'), $request->input('description'));
            return redirect('edit/places')->with('success', 'New place was successfully added');
        }
        return redirect('edit/places')->withErrors($validation->errors());
    }

    public function deleteContinent($id){
        Place::deleteContinent($id);
        return redirect('edit/continents')->with('success', 'Continent was successfully deleted');
    }

    public function deleteCountry($id){
        Place::deleteCountry($id);
        return redirect('edit/countries')->with('success', 'Country was successfully deleted');
    }

    public function deleteCity($id){
        Place::deleteCity($id);
        return redirect('edit/cities')->with('success', 'City was successfully deleted');
    }

    public function deletePlace($id){
        Place::deletePlace($id);
        return redirect('edit/places')->with('success', 'Place was successfully deleted');
    }

    public function placeDetails($id){
        $place_details = Place::getPlaceDetails($id);
        $place_reviews = Place::getReviews($id);
        $tag = $place_details[0]->city_name;
        $tag = str_replace(' ', '', $tag);
        $tag = $tag.'view';
        if (Cache::has("instagram-$tag")) {
            $jsonString = Cache::get("instagram-$tag");
        } else {
            $url = "https://api.instagram.com/v1/tags/$tag/media/recent?client_id=b5201ff169744eefbaabecf19e2beeb8&callback=?&count=9";
            $jsonString = file_get_contents($url);
            Cache::put("instagram-$tag", $jsonString, 10);
        }

        $instagramData = json_decode($jsonString);
        return view('placedetails',
            ['place' => $place_details[0],
                'reviews' => $place_reviews,
                'instagrams' => $instagramData->data
            ]);
    }
}