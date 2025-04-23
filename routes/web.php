<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('superAdmin.dashboard');
// })->middleware(['auth', 'role:1'])->name('dashboard');

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('dashboard');
    // Tambahkan route lain yang hanya bisa diakses oleh Super Admin
});

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'index2'])->name('dashboard');
    // Tambahkan route lain yang hanya bisa diakses oleh Super Admin
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
