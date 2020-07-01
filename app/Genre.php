<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = "genres";

    protected $visible = ['name'];
    
    public function movie()
    {
        return $this->hasOne('App\Movie');
    }
}
