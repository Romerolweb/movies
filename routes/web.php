<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return "I am a test for the routes";
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/othermovies', 'MoviesController@index')->name('movies.index');
