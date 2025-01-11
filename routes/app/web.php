<?php

use App\Http\Controllers\App\DashboardController;
use Illuminate\Support\Facades\Route;

$url = config('app.url');

Route::middleware(['app'])->as('app.')->domain('app.'.$url)->group(function () {
    Route::middleware('auth:web')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    require __DIR__.'/auth.php';
});
