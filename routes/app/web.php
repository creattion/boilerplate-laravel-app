<?php

use App\Http\Controllers\App\DashboardController;
use Illuminate\Support\Facades\Route;

$url = config('app.url');

Route::as('app.')->domain('app.'.$url)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    include __DIR__.'/auth.php';
});
