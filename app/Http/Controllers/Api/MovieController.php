<?php

namespace App\Http\Controllers\Api;

use App\Movie;
use Illuminate\Http\Request;
use App\Http\Resources\Movie as MovieResource;

class MovieController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movie = Movie::orderBy('id', 'desc')->get();

        return $this->showData(MovieResource::collection($movie), 201);

        // return response()->json(MovieResource::collection($movie), 200);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:movies,name|max:255',
            'summary'=>'nullable|max:255',
            'description'=>'nullable|max:255',
            'content'=>'required|max:255',
            'price'=>'nullable|numeric',
            'genre_id'=>'required'
        ]);

        $validator = validator($request->all(),$validate);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }

        $movie = Movie::create($request->all());
        return response()->json(MovieResource::collection($movie), 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {

        $exist = Movie::where('id', $movie)->exists();

        if($exist){
            $toReturn = Movie::where('id', $movie)->first();
            return response()->json(MovieResource::collection($toReturn), 200);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {

        $validate = $request->validate([
            'name' => 'required|unique:movies,name|max:255',
            'summary'=>'nullable|max:255',
            'description'=>'nullable|max:255',
            'content'=>'required|max:255',
            'price'=>'nullable|numeric',
            'genre_id'=>'required'
        ]);

        $validator = validator($request->all(),$validate);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
