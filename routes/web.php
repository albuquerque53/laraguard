<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login')->name('login.form')->middleware('guest');
Route::post('/', [LoginController::class, 'doLogin'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::view('/dashboard', 'dashboard.dash')->middleware('auth:web');

Route::get('/redirect', [LoginController::class, 'redirectToProvider'])
    ->name('redirect');
Route::get('/callback', [LoginController::class, 'handleProviderCallback'])
    ->name('provider.callback');