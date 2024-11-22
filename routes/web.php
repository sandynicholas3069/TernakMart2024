<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;

Route::get('/', [SessionController::class, 'landing'])->name('landing');
Route::get('/login', [SessionController::class, 'loginForm'])->name('login');
Route::post('/login', [SessionController::class, 'login']);
Route::get('/register', [UserController::class, 'registerForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);
Route::get('/dashboard', [SessionController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [SessionController::class, 'logout'])->name('logout');