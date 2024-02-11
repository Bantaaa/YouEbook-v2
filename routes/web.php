<?php

// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\BookController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookReservationController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/



// Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
// Route::get('/', [AuthController::class, 'auth'])->name('auth');
Route::get('/', [BookController::class, 'index'])->name('home');

// Route::post('/custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::post('/register', [AuthController::class, 'signup'])->name('register');
Route::get('/login', [AuthController::class, 'auth'])->name('login');
Route::post('/login', [AuthController::class, 'signin'])->name('login');// Route::post('/custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('books', BookController::class);
Route::get('/reservation/notifications', [BookReservationController::class, 'index'])->name('notifications');



Route::get('/reservation/notifications', [ReservationController::class, 'notifications'])->name('notifications');
Route::resource('book_reservations', BookReservationController::class);
Route::resource('reservation', ReservationController::class);
