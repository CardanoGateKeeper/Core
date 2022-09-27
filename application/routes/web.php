<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    HomeController,
    DashboardController,
    Account\ProfileController,
    Admin\ManageUsersController,
    Admin\ManageEventsController,
    Staff\ScanTicketsController
};

Route::get('/', [HomeController::class, 'index']);
Route::get('event/{eventUUID}', [HomeController::class, 'event'])->name('event');

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::middleware('auth')->group(function() {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Profile
    Route::prefix('profile')->group(function() {
        Route::get('/', [ProfileController::class, 'index'])->name('account.profile');
        Route::post('update', [ProfileController::class, 'update'])->name('account.profile.update');
    });

    // Admin
    Route::prefix('admin')->middleware('admin.only')->group(function() {

        // Manage Users
        Route::prefix('manage-users')->group(function() {
            Route::get('/', [ManageUsersController::class, 'index'])->name('admin.manage-users.index');
            Route::get('add-user', [ManageUsersController::class, 'addUser'])->name('admin.manage-users.add-user');
            Route::get('{userId}/edit', [ManageUsersController::class, 'edit'])->name('admin.manage-users.edit');
            Route::post('save', [ManageUsersController::class, 'save'])->name('admin.manage-users.save');
        });

        // Manage Events
        Route::resource('manage-events', ManageEventsController::class)->parameters([
            'manage-events' => 'event'
        ]);

    });

    // Staff
    Route::prefix('staff')->middleware('staff.only')->group(function() {
        Route::prefix('scan-tickets')->group(function() {
            Route::get('/', [ScanTicketsController::class, 'index'])->name('staff.scan-tickets.index');
            Route::get('{eventUUID}', [ScanTicketsController::class, 'event'])->name('staff.scan-tickets.event');
            Route::post('ajax/register-ticket', [ScanTicketsController::class, 'ajaxRegisterTicket'])->name('staff.scan-tickets.ajax.register-ticket');
        });
    });

});
