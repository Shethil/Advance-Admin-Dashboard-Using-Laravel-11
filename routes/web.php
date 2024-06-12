<?php

use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Backend Routes

Route::prefix('admin')->middleware(['auth'])->group(function () {

    // dashboard
    Route::get('/dashboard', function () {return view('admin.pages.dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

    // resource route
    Route::resource('/module', ModuleController::class);

});

require __DIR__ . '/auth.php';
