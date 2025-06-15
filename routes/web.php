<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/registrasi', [AuthController::class, 'showRegistrationForm']);
Route::post('/registrasi', [AuthController::class, 'register']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// Public routes - dapat diakses tanpa login
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');

// Semua route yang memerlukan authentication
Route::middleware(['auth'])->group(function () {
    // Admin routes - menggunakan resource controller
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('/{admin}', [AdminController::class, 'update'])->name('update');
        
        // Campaign management routes
        Route::post('/campaign/create', [AdminController::class, 'createCampaign'])->name('campaign.create');
        Route::post('/campaign/update', [AdminController::class, 'updateCampaign'])->name('campaign.update');
        Route::post('/campaign/delete', [AdminController::class, 'deleteCampaign'])->name('campaign.delete');
        
        // Route lainnya untuk CRUD yang akan ditambahkan nanti
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/', [AdminController::class, 'store'])->name('store');
        Route::get('/{admin}', [AdminController::class, 'show'])->name('show');
        Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('destroy');
    });
    
    // Profile routes
    Route::resource('profile', ProfileController::class);
    
    // Campaign routes (yang memerlukan login)
    Route::get('/campaigns/{campaign}', [CampaignController::class, 'show'])->name('campaigns.show');
    
    // Donation routes
    Route::resource('donations', DonationController::class);
    Route::post('/donasi', [DonationController::class, 'store'])->name('donasi.store');
});
