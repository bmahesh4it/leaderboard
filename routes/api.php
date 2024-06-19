<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('users', UserController::class);
Route::post('users/{user}/points', [UserController::class, 'updatePoints']);
Route::get('leaderboard', [UserController::class, 'leaderboard']);
