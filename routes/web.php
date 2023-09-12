<?php

use App\Events\ArtistDiscovered;
use App\Models\User;
use App\Mail\JoinMailingList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Mail::to('princekofasiedu@gmail.com')->send(new JoinMailingList());
    return view('welcome');
});

Route::get('/event', function(){
    ArtistDiscovered::dispatch();
});
