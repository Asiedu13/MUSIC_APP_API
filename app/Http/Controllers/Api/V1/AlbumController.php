<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Song;
use App\Models\Album;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use Illuminate\Support\Facades\Validator;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::all();
        $songs = Song::where('is_active', true);
        $tarrray = [];

        foreach($albums as $album) {
            $songs->where('id', $album->id);
            $album_songs = $songs->get();
            $album->songs = $album_songs;
            array_push($tarrray, $album);
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
    public function store(StoreAlbumRequest $request)
    {
        $validatedData = Validator::make($request->all(), [
            'artist_id' => 'required',
            'title' => 'required',
            'number_of_songs' => 'required',
            'date_released' => 'required',
            'ratings' => 'required',
        ]);

        if($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'data' => $validatedData->errors()
            ]);
        }

        $album = Album::create($request->all());
        return response()->json([
            'status' => true,
            'data' => $album
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        // Show album and related songs
        $songs = Song::where('is_active', true);
        
        $songs->where('album_id', $album->id);

        return response()->json(
            [
                'album' => $album->id,
                'numberOfSongs' => $album->number_of_songs,
                'songs' => $songs->get()
            ]
            );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        $validatedData = Validator::make($request->all(), [
            'title' => 'required',
            'artist_id' => 'required',
            'number_of_songs' => 'required',
            'rating' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validatedData->errors(),
            ], 401);
        }
        $album->title = $request->input('title');
        $album->artist_id = $request->input('artist_id');
        $album->number_of_songs = $request->input('number_of_songs');
        $album->rating = $request->input('rating');
        $album->update();

        return response()->json( [
            'status' => 1,
            'data' => $album,
            'msg' => 'Album updated',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $foundAlbum = Album::find($album);

        if(is_null($foundAlbum)) {
            return response()->json([
                'status' => false,
                'message' => 'Album does not exist'
            ]);
        }

        $foundAlbum->delete();
        return response()->json([
                'status' => false,
                'data' => $foundAlbum,
            ]);
        
    }
}
