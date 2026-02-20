<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/login');
});

// REGISTER
Route::get('/register', [AuthController::class, 'showRegister'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// DASHBOARD
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');