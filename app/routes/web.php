<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   return Socialite::driver('keycloak')->redirect();
});
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/auth/redirect', function () {
    return Socialite::driver('keycloak')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('keycloak')->user();
    $response = Http::withHeaders([])
        ->withToken($user->token)
        ->get(
            'http://login-api:8000/hello/user'
        );
    var_dump($response->status());
    echo "<br>";
    var_dump($response->body());
    echo "<br><pre>";
    var_dump($user);
});
