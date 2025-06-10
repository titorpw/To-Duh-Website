<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('homepage.homepage');
})->middleware('guest');

Route::get('signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('signup', [AuthController::class, 'storeSignup'])->name('signup.store');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'storeLogin'])->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/events/create', [EventController::class, 'create'])
    ->middleware('auth')
    ->name('events.create');

// Rute untuk menyimpan event baru dari form
Route::post('/events', [EventController::class, 'store'])
    ->middleware('auth')
    ->name('events.store');

// Rute untuk mengubah status selesai (menggunakan metode PATCH)
Route::patch('/events/{event}/toggle-complete', [EventController::class, 'toggleComplete'])
    ->middleware('auth')
    ->name('events.toggleComplete');

// Rute untuk menghapus event (menggunakan metode DELETE)
Route::delete('/events/{event}', [EventController::class, 'destroy'])
    ->middleware('auth')
    ->name('events.destroy');
