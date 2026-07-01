<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\GameRound;
class Game extends Model
{
    protected $fillable = [

        'game_type_id',

        'name',

        'code',

        'open_time',

        'close_time',

        'result_time',

        'min_bid',

        'max_bid',

        'sort_order',

        'is_active',

        'created_by',

        'updated_by',
        
        'round_duration',

    ];

    protected function casts(): array
    {
        return [

            'open_time' => 'datetime:H:i',

            'close_time' => 'datetime:H:i',

            'result_time' => 'datetime:H:i',

            'min_bid' => 'decimal:2',

            'max_bid' => 'decimal:2',

            'is_active' => 'boolean',

        ];
    }

    /**
     * Game Type Relationship
     */
    public function gameType(): BelongsTo
    {
        return $this->belongsTo(GameType::class);
    }

    /**
     * Created By
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Updated By
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Active Scope
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function rounds(): HasMany
{
    return $this->hasMany(GameRound::class);
}
}