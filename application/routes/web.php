<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{Admin\ManageEventsController,
    HomeController,
    DashboardController,
    Admin\ManageUsersController,
    Staff\ScanTicketsController};

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::middleware('auth')->group(function() {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Admin
    Route::prefix('admin')->middleware('admin.only')->group(function() {

        Route::resource('events', ManageEventsController::class);

        // Manage Users
        Route::prefix('manage-users')->group(function() {
            Route::get('/', [ManageUsersController::class, 'index'])->name('admin.manage-users.index');
            Route::get('add-user', [ManageUsersController::class, 'addUser'])->name('admin.manage-users.add-user');
            Route::get('{userId}/edit', [ManageUsersController::class, 'edit'])->name('admin.manage-users.edit');
            Route::post('save', [ManageUsersController::class, 'save'])->name('admin.manage-users.save');
        });

    });

    // Staff
    Route::prefix('admin')->middleware('staff.only')->group(function() {
        Route::prefix('scan-tickets')->group(function() {
            Route::get('/', [ScanTicketsController::class, 'index'])->name('staff.scan-tickets.index');
            Route::post('ajax/register-ticket', [ScanTicketsController::class, 'ajaxRegisterTicket'])->name('staff.scan-tickets.ajax.register-ticket');
        });
    });

});
