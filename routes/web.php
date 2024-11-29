<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\TransactionController;

Route::get('/', [SessionController::class, 'landing'])->name('landing');
Route::get('/login', [SessionController::class, 'loginForm'])->name('login');
Route::post('/login', [SessionController::class, 'login']);
Route::get('/register', [UserController::class, 'registerForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);
Route::get('/dashboard', [SessionController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [SessionController::class, 'logout'])->name('logout');
Route::resource('product', ProductController::class);
Route::get('/catalogue', [CatalogueController::class, 'index'])->name('catalogue.index');
Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transaction.create');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transaction.store');
Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transaction.destroy');
Route::get('/transactions/recap', [TransactionController::class, 'recapTransaction'])->name('transaction.recap');
Route::get('/product-performance', [TransactionController::class, 'productPerformance'])->name('product.performance');