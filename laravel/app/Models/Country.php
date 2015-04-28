<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    public function continent(){
        return $this->belongsTo('Continent');
    }

}