<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\Game;
use App\Models\GameRound;
use App\Models\Retailer;

class DashboardController extends Controller
{
    public function index()
    {
        $retailer = Retailer::where(
            'user_id',
            auth()->id()
        )->first();

        $game = Game::where('code', 'SPINNER')->first();

        $round = null;

        if ($game) {

            $round = GameRound::where('game_id', $game->id)
                ->where('status', 'OPEN')
                ->latest()
                ->first();

        }

        $todayBet = 0;

        if ($retailer) {

            $todayBet = Bet::where(
                'retailer_id',
                $retailer->id
            )
            ->whereDate('created_at', today())
            ->sum('amount');

        }

     return view(
    'retailer.dashboard.index',
    compact(
        'retailer',
        'game',
        'round',
        'todayBet'
    )
);
    }
}