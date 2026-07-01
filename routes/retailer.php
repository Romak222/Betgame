<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Retailer\DashboardController;
use App\Http\Controllers\Retailer\SpinnerController;

Route::prefix('retailer')
    ->name('retailer.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/spinner', [SpinnerController::class, 'index'])
            ->name('spinner.index');

        Route::post('/spinner/place-bet', [SpinnerController::class, 'placeBet'])
            ->name('spinner.bet');
    });