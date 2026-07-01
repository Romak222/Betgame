<?php

namespace App\Services\Bet;

use App\Models\Bet;
use App\Models\GameRound;
use App\Models\Retailer;
use Illuminate\Support\Facades\DB;
use Exception;

class BetService
{
    public function placeBet(array $data): Bet
    {
        return DB::transaction(function () use ($data) {

            $round = GameRound::findOrFail($data['game_round_id']);

            if ($round->status !== 'OPEN') {
                throw new Exception('Betting is closed.');
            }

            $retailer = Retailer::where('user_id', auth()->id())->firstOrFail();

            return Bet::create([

                'game_round_id' => $round->id,

                'retailer_id' => $retailer->id,

                'selection' => $data['selection'],

                'amount' => $data['amount'],

                'is_winner' => false,

            ]);

        });
    }
}