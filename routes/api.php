<?php

use App\Http\Controllers\InstagramAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstagramController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/instagram/import', [InstagramController::class, 'import']);

Route::post('/instagram/connect', [InstagramAuthController::class, 'store']);
