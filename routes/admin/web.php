<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Panel de administración
Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/metricas', [DashboardController::class, 'metrics'])
    ->name('admin.metrics');

Route::get('/tse-padron', function () {
    return view('public-mod.tse-padron');
})->name('admin.tse-padron');
