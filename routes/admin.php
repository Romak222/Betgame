<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GameTypeController;
use App\Http\Controllers\Admin\RetailerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\GameRoundController;


Route::prefix('admin')
    ->name('admin.')
    ->middleware(['web', 'auth', 'role:Super Admin|Admin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */
                Route::get(
                '/dashboard',
                [DashboardController::class, 'index']
            )->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Retailers
        |--------------------------------------------------------------------------
        */
        Route::get(
            'retailers/datatable',
            [RetailerController::class, 'datatable']
        )->name('retailers.datatable');

        Route::resource('retailers', RetailerController::class);

        /*
        |--------------------------------------------------------------------------
        | Game Types
        |--------------------------------------------------------------------------
        */
        Route::get(
            'game-types/datatable',
            [GameTypeController::class, 'datatable']
        )->name('game-types.datatable');

        Route::resource('game-types', GameTypeController::class);

        /*
        |--------------------------------------------------------------------------
        | Games
        |--------------------------------------------------------------------------
        */

        Route::get(
            'games/datatable',
            [GameController::class, 'datatable']
        )->name('games.datatable');

        Route::resource(
            'games',
            GameController::class
        );




                /*
            |--------------------------------------------------------------------------
            | Game Rounds
            |--------------------------------------------------------------------------
            */

            Route::get(
                'rounds',
                [GameRoundController::class, 'index']
            )->name('rounds.index');

            Route::get(
                'rounds/datatable',
                [GameRoundController::class, 'datatable']
            )->name('rounds.datatable');

            Route::post(
                'rounds',
                [GameRoundController::class, 'store']
            )->name('rounds.store');

            Route::delete(
                'rounds/{round}',
                [GameRoundController::class, 'destroy']
            )->name('rounds.destroy');

            Route::post(
                'rounds/{round}/close',
                [GameRoundController::class, 'close']
            )->name('rounds.close');

            Route::post(
                'rounds/{round}/result',
                [GameRoundController::class,'declareResult']
            )->name('rounds.result');

    });