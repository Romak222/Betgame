<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'retailer_id',
        'balance',
        'hold_balance',
        'total_credit',
        'total_debit',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'balance' => 'decimal:2',
            'hold_balance' => 'decimal:2',
            'total_credit' => 'decimal:2',
            'total_debit' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }
}