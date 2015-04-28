<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Review extends Model{

    public $timestamps = false;


    public function place(){
        return $this->belongsTo('Place');
    }
}