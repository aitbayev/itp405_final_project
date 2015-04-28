<?php namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use Illuminate\Http\Request;
use Validator;

class Place extends Model{

    public function getContinents(){
      return DB::table('continents')->get();
    }

    public function getCountries(){
        return DB::table('countries')->get();
    }

    public function getCountriesWithContinentId($id){
        $query = DB::table('countries')
            ->where('continent_id', '=', $id);
        return $query->get();
    }

    public function getCities(){
        return DB::table('cities')->get();
    }

    public function getPrices(){
        return DB::table('prices')->get();
    }

    public static function getReviews($id){
        $query = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->where('place_id', '=', $id);
        return $query->get();
    }

    public function reviews(){
        return $this->hasMany('Review');
    }
   public static function getSearchResult($continent_id, $country_id){

        $query = DB::table('places');

       if ($continent_id != 'all' && $country_id != 'all'){
           $query
            ->join('continents', 'places.continent_id', '=', 'continents.continent_id')
            ->join('countries', 'places.country_id', '=', 'countries.country_id')
            ->join('cities', 'places.city_id', '=', 'cities.city_id')
            ->where('places.continent_id', '=', $continent_id)
            ->where('places.country_id', '=', $country_id);
           }
       else if ($continent_id == 'all' && $country_id == 'all'){
           $query
               ->join('continents', 'places.continent_id', '=', 'continents.continent_id')
               ->join('countries', 'places.country_id', '=', 'countries.country_id')
               ->join('cities', 'places.city_id', '=', 'cities.city_id');
       }
       else if ($continent_id == 'all' && $country_id != 'all'){
           $query
           ->join('continents', 'places.continent_id', '=', 'continents.continent_id')
               ->join('countries', 'places.country_id', '=', 'countries.country_id')
               ->join('cities', 'places.city_id', '=', 'cities.city_id')
               ->where('places.country_id', '=', $country_id);
       }
       else if ($continent_id != 'all' && $country_id == 'all'){
           $query
               ->join('continents', 'places.continent_id', '=', 'continents.continent_id')
               ->join('countries', 'places.country_id', '=', 'countries.country_id')
               ->join('cities', 'places.city_id', '=', 'cities.city_id')
               ->where('places.continent_id', '=', $continent_id);
       }
        return $query->get();

    }

    public static function getPlaceDetails($id){
        $query = DB::table('places')
            ->join('continents', 'places.continent_id', '=', 'continents.continent_id')
            ->join('countries', 'places.country_id', '=', 'countries.country_id')
            ->join('cities', 'places.city_id', '=', 'cities.city_id')
            ->join('prices', 'places.price_id', '=', 'prices.price_id')
            ->where('places.id','=', $id);
        return $query->get();
    }

    public static function addReview($place_id, $user_id, $review_text){
        $review = new Review();
        $review->place_id = $place_id;
        $review->user_id = $user_id;
        $review->review = $review_text;
        $review->save();
    }

    public static function validate($input){
        return Validator::make($input, [
            'place_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'review' => 'required'
        ]);

    }

    public function getAllPlaces(){
        $query = DB::table('places')
                ->join('continents', 'places.continent_id', '=', 'continents.continent_id')
                ->join('countries', 'places.country_id', '=', 'countries.country_id')
                ->join('cities', 'places.city_id', '=', 'cities.city_id')
                ->join('prices', 'places.price_id', '=', 'prices.price_id');
        return $query->get();
    }
//update
    public static function updateContinentWithId($id, $name ){
        DB::table('continents')
            ->where('continent_id', $id)
            ->update(['continent_name' => $name]);

    }

    public static function updateCountryWithId($id, $name, $continent_id ){
        DB::table('countries')
            ->where('country_id', $id)
            ->update(['country_name' => $name,
                      'continent_id' => $continent_id]);

    }

    public static function updateCityWithId($id, $name ){
        DB::table('cities')
            ->where('city_id', $id)
            ->update(['city_name' => $name]);

    }

    public static function updatePlaceWithId($id,$continent, $country, $city, $price, $description){
        DB::table('places')
            ->where('id', $id)
            ->update(['continent_id' => $continent,
                        'country_id' => $country,
                        'city_id' => $city,
                        'price_id' => $price,
                        'description' => $description]);
    }
//validate update continent
    public static function validateIdName($input){
        return Validator::make($input, [
            'id' => 'required|numeric',
            'name' => 'required'
        ]);
    }

    public static function validateName($input){
        return Validator::make($input, [
           'continent_name' => 'required|unique:continents'
        ]);
    }
//validate update country
    public static function validateIdNameCont($input){
        return Validator::make($input, [
            'id' => 'required|numeric',
            'name' => 'required',
            'continent_id' => 'required|numeric'
        ]);
    }
//validate insert country
    public static function validateCountry($input){
        return Validator::make($input,[
            'country_name' => 'required|unique:countries'
        ]);
    }

    public static function validateCity($input){
        return Validator::make($input,[
            'city_name' => 'required|unique:cities'
        ]);
    }

    public static function validatePlace($input){
        return validator::make($input, [
            'continent_id' =>'required|numeric',
            'country_id' =>'required|numeric',
            'city_id' =>'required|numeric',
            'price_id' =>'required|numeric',
            'description' => 'required|min:100'
        ]);
    }

    public static function addNewContinent($name){
        DB::table('continents')->insert(
            ['continent_name' => $name]
        );
    }

    public static function addNewCountry($name, $continent_id){
        DB::table('countries')->insert(
            ['country_name' => $name,
             'continent_id' => $continent_id]
        );
    }

    public static function addNewCity($name){
        DB::table('cities')->insert(
            ['city_name' => $name]
        );
    }

    public static function addNewPlace($continent, $country, $city, $price, $description){
        DB::table('places')->insert(
            ['continent_id' => $continent,
             'country_id' => $country,
             'city_id' => $city,
             'price_id' => $price,
             'description' =>$description
            ]);
    }
    //delete
    public static function deleteContinent($id){
        DB::table('continents')->where('continent_id', '=', $id)->delete();
    }

    public static function deleteCountry($id){
        DB::table('countries')->where('country_id', '=', $id)->delete();
    }

    public static function deleteCity($id){
        DB::table('cities')->where('city_id', '=', $id)->delete();
    }

    public static function deletePlace($id){
        DB::table('places')->where('id', '=', $id)->delete();
    }
}