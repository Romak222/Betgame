<?php

namespace App\Services\Bet;

use App\Models\Bet;
use App\Models\GameRound;
use Illuminate\Support\Facades\DB;

class WinnerService
{
    public function process(GameRound $round): void
    {
        DB::transaction(function () use ($round) {

            // Reset all bets
            Bet::where('game_round_id', $round->id)
                ->update([
                    'is_winner' => false
                ]);

            // Mark winners
            Bet::where('game_round_id', $round->id)
                ->where('selection', $round->result)
                ->update([
                    'is_winner' => true
                ]);

        });
    }
}