<?php

use App\Http\Controllers\Api\V1\ArtistController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware'=> 'auth:sanctum'], function() {
    Route::get('/artists/search', [ArtistController::class, 'search']);
    Route::apiResource('/artists', ArtistController::class);
    Route::apiResource('albums', AlbumController::class);
    Route::apiResource('songs', SongController::class);
});



Route::post('/register', function(){
    $credentials = [
        'email' => 'admin@admin.com',
        'password' =>  'password'
    ];

    if(!Auth::attempt($credentials)) {
        $user = new App\Models\User();

        $user->name = "person";
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->save();

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $user->email)->first();

            $token = $user->createToken('apiToken');

            return response()->json(
                [
                    'status' => true, 
                    'token' => $token->plainTextToken,
                ], 200
            );
        }
    };
});