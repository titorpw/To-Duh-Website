<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('homepage.homepage');
});

Route::get('signup', [AuthController::class, 'showSignupForm'])->name('signup');

Route::post('signup', [AuthController::class, 'storeSignup'])->name('signup.store');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('login', [AuthController::class, 'storeLogin'])->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware('auth')->name('dashboard');
