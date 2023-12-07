<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaintingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin;
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
Route::get('/', [PaintingController::class, 'index'])->name('home');
Route::get('/detail/{painting}', [PaintingController::class, 'show'])->name('detail');
Route::get('/pricing', [PaymentController::class, 'create'])->name('pricing');
Route::get('/expired', [PageController::class, 'expired'])->name('expired');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/checkout', [PaymentController::class, 'store'])->name('checkout');
    Route::post('/like/{id}', [LikedPaintingController::class, 'store'])->name('like');
    Route::post('/unlike/{id}', [LikedPaintingController::class, 'destroy'])->name('unlike');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('dashboard')->name('dashboard.')->group(function() {
        Route::middleware('role:pelukis')->group(function() {
            Route::get('/paintings', [PaintingController::class, 'userPaintings'])->name('paintings');
            Route::prefix('/paintings')->name('paintings.')->group(function(){
                Route::get('/add', [PaintingController::class, 'create'])->name('add');
                Route::post('/store', [PaintingController::class, 'store'])->name('store');
                Route::get('/{painting}/edit', [PaintingController::class, 'edit'])->name('edit');
                Route::post('/{painting}/update', [PaintingController::class, 'update'])->name('update');
                Route::delete('/{painting}/delete', [PaintingController::class, 'destroy'])->name('delete');
            });
        });

        Route::middleware('role:kurator')->prefix('kurator')->name('kurator.')->group(function() {
            Route::get('/paintings', [Admin\PaintingController::class, 'index'])->name('paintings');
            Route::prefix('/paintings')->name('paintings.')->group(function(){
                Route::get('/{painting}/detail', [Admin\PaintingController::class, 'show'])->name('detail');
                Route::get('/{painting}/approve', [Admin\PaintingController::class, 'approve'])->name('approve');
                Route::get('/{painting}/reject', [Admin\PaintingController::class, 'reject'])->name('reject');
            });
        });
    });
});
