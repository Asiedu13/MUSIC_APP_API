<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Song;
use App\Models\Album;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSongRequest;
use App\Http\Requests\UpdateSongRequest;
use Illuminate\Support\Facades\Validator;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Song::all();
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
    public function store(StoreSongRequest $request)
    {
         $validatedData = Validator::make($request->all(), [
            'album_id' => 'required',
            'artist_id' => 'required',
            'title' => 'required',
            'genre' => 'required',
            'date_released' => 'required',
            'ratings' => 'required',
        ]);

        if($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'data' => $validatedData->errors()
            ]);
        }

        $song = Song::create($request->all());
        return response()->json([
            'status' => true,
            'data' => $song
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        $albums = Album::where('is_active', true);
        
        $albums->where('id', $song->album_id);

        return response()->json(
            [
                'album' => $albums->get(),
                'song' => $song
            ]
            );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSongRequest $request, Song $song)
    {
         $validatedData = Validator::make($request->all(), [
            'title' => 'required',
            'album_id' => 'required',
            'artist_id' => 'required',
            'genre' => 'required',
            'date_released' => 'required',
            'rating' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validatedData->errors(),
            ], 401);
        }
        $song->title = $request->input('title');
        $song->album_id = $request->input('album_id');
        $song->artist_id = $request->input('artist_id');
        $song->genre = $request->input('genre');
        $song->date_releaseds = $request->input('date_releaseds');
        $song->rating = $request->input('rating');
        $song->update();

        return response()->json( [
            'status' => 1,
            'data' => $song,
            'msg' => 'Song updated',
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        $foundSong = Song::find($song);

        if(is_null($foundSong)) {
            return response()->json([
                'status' => false,
                'message' => 'Song does not exist'
            ]);
        }

        $foundSong->delete();
        return response()->json([
                'status' => false,
                'data' => $foundSong,
            ]);
        
    }
}
