<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\AttendanceController;
use App\Http\Controllers\User\TaskController as UserTaskController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('/export-attendance', [AdminDashboard::class, 'export'])->name('export');
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('tasks', AdminTaskController::class)->except(['show']);
    Route::resource('attendances', App\Http\Controllers\Admin\AttendanceController::class)->only(['edit', 'update', 'destroy']);
    Route::resource('lab_heads', App\Http\Controllers\Admin\LabHeadController::class)->except(['show', 'create', 'edit']);
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    Route::get('/export-attendance', [UserDashboard::class, 'export'])->name('export');
    Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/tasks', [UserTaskController::class, 'index'])->name('tasks');
    Route::patch('/tasks/{task}/complete', [UserTaskController::class, 'complete'])->name('tasks.complete');
});
