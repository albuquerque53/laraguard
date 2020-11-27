<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Password\ForgotPasswordController;
use App\Http\Controllers\Password\ResetPasswordController;
use App\Http\Controllers\ProviderController;
use Illuminate\Auth\Notifications\ResetPassword;
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

Route::prefix('github')->group(function() {
    Route::get('redirect', [
        ProviderController::class, 'redirectToProvider'
    ])->name('github.redirect');

    Route::get('callback', [
        ProviderController::class, 'handleProviderCallback'
    ])->name('github.callback');
});

Route::view('/forgot-password', 'auth.forgot-password')
    ->middleware('guest')->name('forgot.password');
Route::post('/forgot-password', [
    ForgotPasswordController::class, 'sendEmailLink'
])->middleware('guest')->name('reset.send');

Route::get('/reset-password/{token}', [
    ResetPasswordController::class, 'confirmToken'
])->middleware('guest')->name('confirm.token');
Route::post('/reset-password', [
    ResetPasswordController::class, 'updatePassword'
])->middleware('guest')->name('password.reset');