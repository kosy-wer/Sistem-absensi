<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AttendanceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(Authenticate::using('sanctum'));


Route::post('/attendances', [AttendanceController::class, 'store']);
Route::get('/attendances/{name}/{class}', [AttendanceController::class, 'index']);



