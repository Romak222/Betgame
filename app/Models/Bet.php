<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bet extends Model
{
    protected $fillable = [
        'game_round_id',
        'retailer_id',
        'selection',
        'amount',
        'is_winner',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'is_winner' => 'boolean',
        ];
    }

    public function round(): BelongsTo
    {
        return $this->belongsTo(GameRound::class, 'game_round_id');
    }

    public function retailer(): BelongsTo
    {
        return $this->belongsTo(Retailer::class);
    }
}