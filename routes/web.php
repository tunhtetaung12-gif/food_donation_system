<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProfileController;

// 1. Landing Page
Route::get('/', function () {
    return view('welcome');
});

// 2. User Dashboard (For Donors/Volunteers/Receivers)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. User Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Admin Routes (Add this section)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::post('/admin/assign', [AdminController::class, 'assignVolunteer'])->name('admin.assign');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // User Management CRUD
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::post('/assign', [AdminController::class, 'assignVolunteer'])->name('assign');
});

Route::middleware(['auth', 'role:donor'])->group(function () {
    Route::get('/donate', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/donate', [DonationController::class, 'store'])->name('donations.store');
});

Route::get('/donate/success/{id}', [DonationController::class, 'success'])->name('donations.success');

require __DIR__ . '/auth.php';
