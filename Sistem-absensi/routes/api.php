<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(Authenticate::using('sanctum'));


Route::post('/orders', [OrderController::class, 'store']);

//posts
Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
