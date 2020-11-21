<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login')->name('login.form')->middleware('guest');
Route::post('/', [LoginController::class, 'doLogin'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::view('/dashboard', 'dashboard.dash')->middleware('auth:web');

Route::prefix('google')->group(function() {
    Route::get('redirect', [
        ProviderController::class, 'redirectToProvider'
    ])->name('google.redirect');
    
    Route::get('callback', [
        ProviderController::class, 'handleProviderCallback'
    ])->name('google.callback');
});