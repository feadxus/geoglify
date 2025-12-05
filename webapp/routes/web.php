<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return inertia('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::post('/users/list', [UserController::class, 'list'])->name('users.list');

    Route::resource('/roles', RoleController::class);
    Route::post('/roles/list', [RoleController::class, 'list'])->name('roles.list');

    Route::post('/locale/set', [\App\Http\Controllers\LocaleController::class, 'set'])->name('locale.set');
});

require __DIR__ . '/auth.php';
