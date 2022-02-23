<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

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


require __DIR__.'/auth.php';


Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('root');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->name("users.")->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get("{id}", [UserController::class, 'show'])->name('show');
    });
});
