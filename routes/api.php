<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware(['valdate.token'])->group(function () {
    Route::get('userInfo', [AuthController::class, 'userInfo']);
});
