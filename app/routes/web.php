<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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
Route::get('/auth/callback', function () {
    $socialite = Socialite::driver('keycloak')->user();
    $user = User::createFromOauth($socialite);
    $cookie = cookie('jwt', $user->token, 1);
    return redirect(url()->previous())->cookie($cookie);
});

Route::get('/logout', function(Request $request){
    $cookie = cookie('jwt','', );
    return redirect(env('KEYCLOAK_BASE_URL')."/realms/login/protocol/openid-connect/logout")->cookie($cookie);;
});

Route::get('/', function (Request $request) {
    $response = Http::withToken($request->cookie('jwt'))
        ->get(
            env('API_URL').'/user'
        );
    $response->throw();
    $return = $response->json();
    $body = $response->body();
    $status = $response->status();
    $username = $return['nome'];
    return view('welcome',compact('username','body','status'));
})->middleware("ouath");



