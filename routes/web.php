<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduledPostController;


Route::get('/', function () {
    return view('welcome');
});




Route::get('/dashboard/profile/{id}', [DashboardController::class, 'profile']);


Route::get('/schedule/create', [ScheduledPostController::class, 'create']);
Route::post('/schedule/store', [ScheduledPostController::class, 'store']);
