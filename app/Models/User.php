<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = [

        'username',

        'login_id',

        'email',

        'password',

        'status',

        'last_login_at'

    ];

    protected $hidden = [

        'password',

        'remember_token'

    ];

    protected function casts(): array
    {
        return [

            'email_verified_at'=>'datetime',

            'last_login_at'=>'datetime',

            'password'=>'hashed',

            'status'=>'boolean'

        ];
    }

    public function retailer()
    {
        return $this->hasOne(Retailer::class);
    }
}