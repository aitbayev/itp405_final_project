<?php namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class Continent extends Model{

    public function countries(){
        return $this->hasMany('Country');
    }

}