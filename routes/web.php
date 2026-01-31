<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::post('/admin/assign', [AdminController::class, 'assignVolunteer'])->name('admin.assign');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');


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
Route::post('/admin/assign', [AdminController::class, 'assignVolunteer'])->name('admin.assign');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/donations', [AdminController::class, 'manageDonations'])->name('donations.index');
    Route::post('/donations/assign', [AdminController::class, 'assignVolunteer'])->name('donations.assign');
});


require __DIR__ . '/auth.php';
