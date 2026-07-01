<?php

namespace App\Services;

use App\Models\Bet;
use App\Models\Game;
use App\Models\GameRound;
use App\Models\Retailer;
use Exception;
use Illuminate\Support\Facades\DB;

class SpinnerService
{
    public function __construct(
        protected WalletService $walletService
    ) {}

    public function getActiveGame(): Game
    {
        return Game::where('code', 'SPINNER')
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function getOpenRound(): GameRound
    {
        $game = $this->getActiveGame();

        return GameRound::where('game_id', $game->id)
            ->where('status', 'OPEN')
            ->latest()
            ->firstOrFail();
    }

    public function placeBet(Retailer $retailer, array $bets): array
    {
        return DB::transaction(function () use ($retailer, $bets) {

            $game = $this->getActiveGame();
            $round = $this->getOpenRound();

            $totalAmount = collect($bets)->sum('amount');

            if ($totalAmount < $game->min_bid) {
                throw new Exception('Minimum bet amount is ₹' . $game->min_bid);
            }

            if ($totalAmount > $game->max_bid) {
                throw new Exception('Maximum bet amount is ₹' . $game->max_bid);
            }

            $createdBets = [];

            foreach ($bets as $bet) {
                $createdBets[] = Bet::create([
                    'game_round_id' => $round->id,
                    'retailer_id' => $retailer->id,
                    'selection' => $bet['number'],
                    'amount' => $bet['amount'],
                    'is_winner' => false,
                    'status' => 'PENDING',
                    'win_amount' => 0,
                    'odds' => 9,
                    'result_number' => null,
                ]);
            }

            $this->walletService->debitForBet(
                $retailer,
                $totalAmount,
                Bet::class,
                $round->id
            );

            return [
                'round' => $round,
                'total_amount' => $totalAmount,
                'bets' => $createdBets,
            ];
        });
    }
}