<?php

use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('page/{page_slug}', [FrontendController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Backend Routes

Route::prefix('admin')->middleware(['auth'])->group(function () {

    // dashboard
    // Route::get('/dashboard', function () {return view('admin.pages.dashboard');})->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


    // resource route
    Route::resource('/module', ModuleController::class);
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/page', PageController::class);
    Route::get('check/page/is_active/{page_id}', [PageController::class, 'checkActive'])->name('page.is_active.ajax');
    Route::resource('/backup', BackupController::class)->only(['index','store','destroy']);

    Route::resource('/users', UserController::class);
    Route::get('check/user/is_active/{user_id}', [UserController::class, 'checkActive'])->name('user.is_active.ajax');

    // Profile Management Routes
    Route::get('update-profile', [ProfileController::class, 'getUpdateeProfile'])->name('getupdate.profile');
    Route::post('update-profile', [ProfileController::class, 'updateProfile'])->name('postupdate.profile');

    Route::get('update-password', [ProfileController::class, 'getUpdatePassword'])->name('getupdate.password');
    Route::post('update-password', [ProfileController::class, 'updatePassword'])->name('postupdate.password');

});

require __DIR__ . '/auth.php';
