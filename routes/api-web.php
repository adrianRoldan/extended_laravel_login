<?php

use App\Http\Controllers\WebApi\UserController;
use App\Http\Controllers\WebApi\UserEmailController;
use Illuminate\Support\Facades\Route;

//Solo aceptamos peticiones a la api interna vía XMLHttpRequest
Route::middleware('ajax')->group(function () {

    Route::prefix('users')->group(function () {

        Route::get('/', [UserController::class, "users"]);
        Route::get('/{id}', [UserController::class, "find"]);
        Route::delete('/{id}', [UserController::class, "delete"]);

        Route::prefix('emails')->group(function () {

            Route::get('/{user_id}', [UserEmailController::class, "emailsUser"]);
            Route::post('/save', [UserEmailController::class, "save"]);
            Route::delete('/{email_id}', [UserEmailController::class, "delete"]);
            Route::put('/update', [UserEmailController::class, "update"]);
        });

    });
});

