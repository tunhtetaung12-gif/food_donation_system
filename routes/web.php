<?php

use App\Models\Donation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupportRequestController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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

    Route::get('/users/{user}', [AdminController::class, 'show'])->name('users.show');

    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

    Route::get('/users', [AdminController::class, 'manageUsers'])->name('users.index');

    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');

    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');

    Route::post('/assign', [AdminController::class, 'assignVolunteer'])->name('assign');
});


Route::middleware(['auth', 'role:donor'])->group(function () {

    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');

    Route::get('/donations/{donation}/edit', [DonationController::class, 'edit'])->name('donations.edit');

    Route::put('/donations/{donation}', [DonationController::class, 'update'])->name('donations.update');

    Route::get('/donate', [DonationController::class, 'create'])->name('donations.create');

    Route::post('/donate', [DonationController::class, 'store'])->name('donations.store');
});

Route::get('/donate/success/{id}', [DonationController::class, 'success'])->name('donations.success');

Route::post('/admin/assign', [AdminController::class, 'assignVolunteer'])->name('admin.assign');



Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/donations', [AdminController::class, 'manageDonations'])->name('donations.index');

    Route::post('/donations/assign/{id}', [AdminController::class, 'assignVolunteer'])
        ->name('donations.assign');

    Route::get('/support-requests', [AdminController::class, 'manageSupportRequests'])->name('support.index');
    Route::patch('/support-requests/{id}', [AdminController::class, 'updateRequestStatus'])->name('support.update');
});

Route::post('/dashboard/complete/{id}', [DashboardController::class, 'complete'])
    ->name('volunteer.donations.complete')
    ->middleware('auth');

Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/requests/create', [SupportRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [SupportRequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/history', [SupportRequestController::class, 'index'])->name('requests.history');
});


require __DIR__ . '/auth.php';
