<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;

// ──────────────────────────────────────────────
// Rutas públicas (solo para invitados)
// ──────────────────────────────────────────────
Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'store'])
        ->middleware('throttle:login')
        ->name('login.store');
});

// ──────────────────────────────────────────────
// Rutas protegidas (requieren autenticación)
// ──────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Páginas informativas
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // CRUD de publicaciones (7 rutas RESTful)
    Route::resource('posts', PostController::class);

    // Logout
    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');
});
