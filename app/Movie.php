<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = "movies";

    protected $fillable = ['name', 'summary', 'description', 'content', 'price', 'genre_id'];

    public function file()
    {
        return $this->hasMany('App\File');
    }
}
