<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('Auth/Login');
})->name('login');
Route::get('/register', function () {
    return view('Auth/register');
})->name('register');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    
});

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'index']);
    Route::get('', [MahasiswaController::class,'']);
});
