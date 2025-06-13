<?php

use App\Http\Controllers\FeedbacksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TAKController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Feedback;
use Illuminate\Http\Request;

if('/' === env('APP_URL')) {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
} else {
    Route::get('/', function () {
        return redirect()->route('login');
    });
}

Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/login', function () {
        return view('Auth/Login');
    })->name('login');

    Route::get('/register', function () {
        return view('Auth/register');
    })->name('register');
});

Route::middleware( ['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'editUser'])->name('admin.users');
    Route::put('/admin/users', [AdminController::class, 'updateUser'])->name('admin.update');
    Route::delete('/admin/users', [AdminController::class, 'deleteUser'])->name('admin.destroy');
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/update-profile', [MahasiswaController::class, 'editProfile'])->name('mahasiswa.update.profile');
    Route::put('/mahasiswa/update-profile', [MahasiswaController::class, 'updateProfile'])->name('mahasiswa.update.profile.submit');
    Route::delete('/mahasiswa/delete-profile', [MahasiswaController::class, 'destroy'])->name('mahasiswa.delete.profile');
    
    Route::put('/mahasiswa/tak/{id}', [TAKController::class, 'updateTak'])->name('mahasiswa.tak.update');
    Route::get('/mahasiswa/tak/create', [MahasiswaController::class, 'createTak'])->name('mahasiswa.tak.create');
    Route::get('/mahasiswa/tak/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.tak.edit');
    Route::post('/mahasiswa/tak/store', [TAKController::class, 'store'])->name('mahasiswa.tak.store');
    Route::delete('/mahasiswa/tak/{id}', [TAKController::class, 'destroy'])->name('mahasiswa.tak.destroy');

    Route::get('/mahasiswa/feedback', [FeedbacksController::class, 'index'])->name('mahasiswa.feedback');
    Route::post('/mahasiswa/feedback', [FeedbacksController::class, 'store'])->name('feedbacks.store');
    Route::get('/mahasiswa/feedback/{id}/edit', [FeedbacksController::class, 'edit'])->name('feedbacks.edit');
    Route::put('/mahasiswa/feedback/{id}', [FeedbacksController::class, 'update'])->name('feedbacks.update');
    Route::get('/mahasiswa/feedback/create', [FeedbacksController::class, 'create'])->name('feedbacks.create');
    Route::delete('/mahasiswa/feedback/{feedback}', [FeedbacksController::class, 'destroy'])->name('feedbacks.destroy');

});
