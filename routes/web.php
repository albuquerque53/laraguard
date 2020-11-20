<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login')->name('login.form');
Route::post('/', [
    LoginController::class, 'doLogin'
    ])->name('login');

Route::get('/dashboard', function() {
    return view('dashboard.dash');
})->middleware('auth:web');

Route::get('/logout', [
    LoginController::class, 'logout'
    ])->name('logout');