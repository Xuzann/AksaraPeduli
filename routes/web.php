<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

// AUTH ROUTES
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/registrasi', function () {
    return view('registrasi');
});

// USER ROUTES
Route::get('/profile', function () {
    return view('profile');
});

Route::get('/adminprofile', function () {
    return view('adminprofile');
});

Route::get('/campaigns', function () {
    return view('campaigns');
});

Route::get('/display_image', function () {
    return view('display_image');
});

Route::get('/get_donations', function () {
    return view('get_donations');
});

Route::get('/get_usersdonations', function () {
    return view('get_usersdonation');
});

Route::get('/hapusakun', function () {
    return view('hapusakun');
});

// ROUTES YANG HARUSNYA DIHANDLE DENGAN METHOD POST ATAU CONTROLLER
Route::post('/proseslogin', [AuthController::class, 'login']); // Optional jika login manual
Route::post('/prosestambahuser', function () {
    // Tambahkan logika simpan user baru
});

Route::post('/upload-profile', [UserController::class, 'uploadProfileImage'])->name('profile.upload');
Route::get('/display-image/{user_id}', [UserController::class, 'getProfileImage'])->name('profile.image');

Route::get('/upload', function () {
    return view('upload');
});
