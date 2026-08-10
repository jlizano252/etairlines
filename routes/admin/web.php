<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Dashboard\UsersTable;

// Panel de administración
Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/metricas', [DashboardController::class, 'metrics'])
    ->name('admin.metrics');

Route::get('/tse-padron', function () {
    return view('public-mod.tse-padron');
})->name('admin.tse-padron');

Route::middleware('superadmin')->group(function () {

    Route::get('/users', function () {
        return view('dashboard-mod.users-layout');
    })->name('admin.users.index');
});
