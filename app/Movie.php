<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = "movies";
    // public $timestamps = true;

    // protected $fillable = [''];

    public function phone()
    {
        return $this->hasOne('App\Phone');
    }
}
