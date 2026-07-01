<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Model\GameRound;

class Bet extends Model
{
    protected $fillable = [
        'game_round_id',
        'retailer_id',
        'selection',
        'amount',
        'is_winner',
        'status',
        'win_amount',
        'odds',
        'result_number',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'win_amount' => 'decimal:2',
            'odds' => 'decimal:2',
            'is_winner' => 'boolean',
            'result_number' => 'integer',
        ];
    }

    public function round()
    {
        return $this->belongsTo(GameRound::class, 'game_round_id');
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}