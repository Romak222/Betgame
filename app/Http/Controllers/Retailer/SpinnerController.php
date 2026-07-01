<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameRound;

class SpinnerController extends Controller
{
    public function index()
    {
        $game = Game::where('code', 'SPINNER')
            ->where('is_active', true)
            ->first();

        if (!$game) {
            abort(404, 'Spinner game not found.');
        }

        $round = GameRound::where('game_id', $game->id)
            ->where('status', 'OPEN')
            ->latest()
            ->first();

        return view(
            'retailer.spinner.index',
            compact(
                'game',
                'round'
            )
        );
    }

// public function index()
// {
//     $game = Game::where('code', 'SPINNER')->first();

//     dd($game);
// }
}