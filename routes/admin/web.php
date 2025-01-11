<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->domain(config('app.url'))->prefix('admin')->as('admin.')->group(function () {
    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    require __DIR__.'/auth.php';
});
