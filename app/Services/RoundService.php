<?php

namespace App\Services;

use App\Models\Game;
use App\Models\GameRound;
use Carbon\Carbon;

class RoundService
{
    public function getOrCreateOpenRound(Game $game): GameRound
    {
        $now = Carbon::now();

        $openRound = GameRound::where('game_id', $game->id)
            ->where('status', 'OPEN')
            ->where('end_time', '>', $now)
            ->latest()
            ->first();

        if ($openRound) {
            return $openRound;
        }

        GameRound::where('game_id', $game->id)
            ->where('status', 'OPEN')
            ->where('end_time', '<=', $now)
            ->update(['status' => 'CLOSED']);

        return GameRound::create([
            'game_id' => $game->id,
            'round_no' => now()->format('YmdHis'),
            'start_time' => $now,
            'end_time' => $now->copy()->addSeconds($game->round_duration_seconds ?? 90),       
            'status' => 'OPEN',
        ]);
    }
}