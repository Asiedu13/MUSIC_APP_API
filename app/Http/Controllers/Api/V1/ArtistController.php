<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Album;
use App\Models\Artist;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArtistRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateArtistRequest;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::all();
        $albums = Album::where('is_active', true);
        $tarrray = [];

        foreach($artists as $artist) {
            $albums->where('artist_id', $artist->id);
            $artist_albums = $albums->get();
            $artist->albums = $artist_albums;
            array_push($tarrray, $artist);
        }
        return response()->json(
            [
                'data' => $tarrray,
            ]
            );


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtistRequest $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'stage_name' => 'required',
            'record_label' => 'required',
        ]);

        if($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'data' => $validatedData->errors()
            ]);
        }

        $artist = Artist::create($request->all());
        return response()->json([
            'status' => true,
            'data' => $artist
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {

        return response()->json(
            [
                'status' => true,
                'data' => $artist
            ]
            );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArtistRequest $request, Artist $artist)
    {
         $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'stage_name' => 'required',
            'record_label' => 'required',
            'password' => 'required',
            'rating' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validatedData->errors(),
            ], 401);
        }
        $artist->name = $request->input('email');
        $artist->email = $request->input('email');
        $artist->stage_name = $request->input('stage_name');
        $artist->record_label = $request->input('record_label');
        $artist->password = $request->input('password');
        $artist->rating = $request->input('rating');
        $artist->update();

        return response()->json( [
            'status' => 1,
            'data' => $artist,
            'msg' => 'Artist updated',
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        $foundArtist = Artist::find($artist);

        if(is_null($foundArtist)) {
            return response()->json([
                'status' => false,
                'message' => 'Artist does not exist'
            ]);
        }

        $foundArtist->delete();
        return response()->json([
                'status' => false,
                'data' => $foundArtist,
            ]);
        
    }
}
