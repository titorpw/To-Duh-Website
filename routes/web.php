<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CalendarController;

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

// Rute untuk menampilkan halaman Kalender
Route::get('/calendar', [CalendarController::class, 'index'])
    ->middleware('auth')
    ->name('calendar.index');

// Rute API untuk menyediakan data event ke kalender
Route::get('/api/events', [EventController::class, 'getEventsForCalendar'])
    ->middleware('auth')
    ->name('api.events');

// Rute untuk menyimpan event baru dari form
Route::post('/events', [EventController::class, 'store'])
    ->middleware('auth')
    ->name('events.store');

Route::get('/events/{event}/edit', [EventController::class, 'edit'])
    ->middleware('auth')
    ->name('events.edit');

// Rute untuk memproses update event dari form
Route::patch('/events/{event}', [EventController::class, 'update'])
    ->middleware('auth')
    ->name('events.update');

// Rute untuk mengubah status selesai (menggunakan metode PATCH)
Route::patch('/events/{event}/toggle-complete', [EventController::class, 'toggleComplete'])
    ->middleware('auth')
    ->name('events.toggleComplete');

// Rute untuk menghapus event (menggunakan metode DELETE)
Route::delete('/events/{event}', [EventController::class, 'destroy'])
    ->middleware('auth')
    ->name('events.destroy');
