<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Retailer\SpinnerController;
use App\Http\Controllers\Retailer\DashboardController;
Route::middleware(['web'])
    ->prefix('retailer')
    ->name('retailer.')
    ->group(function () {

     Route::get(
    '/dashboard',
    [DashboardController::class, 'index']
)->name('dashboard');

Route::get(
    '/spinner',
    [SpinnerController::class, 'index']
)->name('spinner.index');

        /*
        |--------------------------------------------------------------------------
        | Spinner
        |--------------------------------------------------------------------------
        */

        Route::get(
            'spinner',
            [SpinnerController::class,'index']
        )->name('spinner.index');

        Route::post(
            'spinner/place-bet',
            [SpinnerController::class,'placeBet']
        )->name('spinner.bet');

    });