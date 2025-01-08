<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::get('/', function (Request $request) {
    $token = $request->bearerToken();  // Pega o token do cabeçalho Authorization
    $response = Http::withToken($token)->get(env('API_URL') . '/user');
    
    $response->throw();
    $return = $response->json();
    $body = $response->body();
    $status = $response->status();
    $user = $return;
    return view('welcome',compact('user','body','status'));
});
