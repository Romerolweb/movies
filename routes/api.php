<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/movie', 'Api\MovieController@index')->name('movies.index');
Route::resource('genre', 'Api\GenreController');
Route::resource('file', 'Api\FileController');
Route::resource('movie', 'Api\MovieController');
