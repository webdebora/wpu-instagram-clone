<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;

// Show profile
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
// Show edit profile form
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
// Update profile
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


Route::get('/', function () {
    return view('welcome');
});

// Route untuk home
Route::get('home', [PhotoController::class, 'index'])->name('home');


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Route yang dilindungi oleh middleware auth
Route::middleware('auth')->group(function () {
    Route::get('photos/create', [PhotoController::class, 'create'])->name('photos.create');
    Route::get('photos/index', [PhotoController::class, 'index'])->name('photos.index');
    Route::post('photos', [PhotoController::class, 'store'])->name('photos.store');
    Route::get('photos/{photo}/edit', [PhotoController::class, 'edit'])->name('photos.edit');
    Route::put('photos/{photo}', [PhotoController::class, 'update'])->name('photos.update');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy')->middleware('auth');
    Route::post('photos/{photo}/like', [PhotoController::class, 'like'])->name('photos.like');
    Route::delete('/photos/{photo}/unlike', [PhotoController::class, 'unlike'])->name('photos.unlike');
    Route::post('photos/{photo}/comment', [PhotoController::class, 'addComment'])->name('comments.store');

    // Logout route
    Route::post('logout', function () {
        Auth::logout();
        return redirect('/'); // Arahkan kembali ke halaman utama setelah logout
    })->name('logout');
});
