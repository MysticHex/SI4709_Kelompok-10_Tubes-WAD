<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TAKController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('guest:sanctum')->post('/register', [AuthController::class, 'register'])->name('api.register');
Route::middleware('guest:sanctum')->post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('api.logout');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/update-status/{id}', [TAKController::class, 'updateTakStatus'])->name('updateStatus');
    Route::post('/admin/update-point/{id}', [TAKController::class, 'updatePoint'])->name('updatePoint');
});
