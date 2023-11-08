<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LikedPaintingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/detail/{painting}', [PageController::class, 'detail'])->name('detail');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/pricing', [PaymentController::class, 'create'])->name('pricing');
    Route::post('/like/{id}', [LikedPaintingController::class, 'store'])->name('like');
    Route::post('/unlike/{id}', [LikedPaintingController::class, 'destroy'])->name('unlike');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
