<?php

use App\Genre;
use App\Movie;
use App\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $genre = [];
        for ($i = 0; $i <= 2; $i++) {
            $genre[$i] = Genre::create([
            'name' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
            ]);
        }

        for ($i = 0; $i <= 2; $i++) {
            $movie = Movie::create([
            'name' => Str::random(10),
            'summary' => Str::random(10),
            'description' => Str::random(10),
            'country' => Str::random(10),
            'price' => 5000,
            'created_at' => now(),
            'updated_at' => now(),
            'genre_id' => $genre[$i]->id,
            ]);
        }
        
        $file = [];
        for ($i = 0; $i <= 4; $i++) {
            $file[$i] = File::create([
            'uri' => 'files/'.Str::random(10).'png',
            'type' => 'image',
            'created_at' => now(),
            'updated_at' => now(),
            'movie_id' => $movie->id,
            ]);
        }
    }
}
