<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/registrasi', function () {
    return view('registrasi');
});

Route::get('/profile', function () {
    return view ('profile');
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

Route::get('/logout', function () {
    return view('logout');
});

Route::get('/proseslogin', function () {
    return view('proseslogin');
});

Route::get('/prosestambahuser', function () {
    return view('prosestambahuser');
});

Route::get('/upload', function () {
    return view('upload');
});