<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Tambahkan route lain yang hanya bisa diakses oleh Super Admin
    Route::get('superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('category', CategoriesController::class);
    Route::resource('products', ProductController::class);

    Route::get('getUser', [UserController::class, 'getUser'])->name('getUser');

    Route::get('pos', [ProductController::class, 'getProduct'])->name('pos.dashboard');
    Route::post('pos', [OrderController::class, 'store'])->name('pos.store');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
