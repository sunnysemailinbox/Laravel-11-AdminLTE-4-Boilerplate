<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*# USERS #*/
    Route::get('/users/datatables/resources', [UserController::class, 'getDatatablesResources'])->name('users.datatables.resources');
    Route::resource('users', UserController::class);

    /*# ROLES #*/
    Route::get('/roles/{role}/permissions', [RoleController::class, 'showPermissions'])->name('roles.permissions');
    Route::patch('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.update.permissions');
    Route::get('/roles/datatables/resources', [RoleController::class, 'getDatatablesResources'])->name('roles.datatables.resources');
    Route::resource('roles', RoleController::class);
});

require __DIR__.'/auth.php';
