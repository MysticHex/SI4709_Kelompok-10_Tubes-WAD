<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;

// Route::get('/', action: function () {
//     return view('welcome');

// if (env('APP_ENV') === 'local') {
//     Route::get('/', function () {
//         return view('welcome');
//     })->name('home');
// } else {
//     Route::get('/', function () {
//         return redirect()->route('login');
//     });
// }

Route::get('/', function () {
    return redirect()->route('login');
});
// })->name('home');

Route::get('/login', function () {
    return view('Auth/Login');
})->name('login');

Route::get('/register', function () {
    return view('Auth/register');
})->name('register');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
});

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
});


