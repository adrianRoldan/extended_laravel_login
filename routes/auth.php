<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {

    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);


    Route::group(["prefix" => "auth"], function() {

        Route::get('google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
        Route::get('google/callback', [AuthController::class, 'handleGoogleLoginCallback'])->name('google.callback');
    });
});

Route::middleware('auth')->group(function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

});
