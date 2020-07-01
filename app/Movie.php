<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = "movies";

    protected $fillable = ['name', 'summary', 'description', 'content', 'price'];

    public function genre()
    {
        return $this->hasOne('App\Genre');
    }

    public function file()
    {
        return $this->hasMany('App\File');
    }
}
