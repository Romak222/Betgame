<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Bet;
use App\Models\Wallet;

class Retailer extends Model
{
    protected $fillable = [

        'user_id',

        'shop_name',

        'shop_code',

        'owner_name',

        'mobile',

        'alternate_mobile',

        'address',

        'city',

        'state',

        'pincode',

        'margin',

        'daily_limit',

        'status',

        'notes',

        'last_login',
        'balance',

    ];

    protected function casts(): array
    {
        return [

            'margin'=>'decimal:2',

            'daily_limit'=>'decimal:2',

            'status'=>'boolean',

            'last_login'=>'datetime',
            'balance' => 'decimal:2',

        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bets(): HasMany
{
    return $this->hasMany(Bet::class);
}

public function wallet()
{
    return $this->hasOne(Wallet::class);
}
}