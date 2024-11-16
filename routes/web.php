<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

// Route untuk auth yang bisa diakses public
Route::get('/auth/login', function () {
    return view('auth/login');
})->name('login');  // Tambahkan name untuk redirect

Route::get('/auth/register', function () {
    return view('auth/register');
});

// Group route yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    
    Route::get('/dashboard/profile', function () {
        return view('dashboard/profile');
    });
});
