<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $fillable = [
        'wallet_id',
        'retailer_id',
        'type',
        'purpose',
        'amount',
        'balance_before',
        'balance_after',
        'reference_type',
        'reference_id',
        'remarks',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'balance_before' => 'decimal:2',
            'balance_after' => 'decimal:2',
        ];
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}