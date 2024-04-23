<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AppUser extends Authenticatable implements JWTSubject
{
    protected $table = 'app_users';

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
    protected $fillable = [
        'name',
        'image',
        'phone',
        'password',
        'type',
        'device_token',
        'session',
    ];

    public function shop(): HasOne
    {
        return $this->hasOne(Shop::class,'vendor_id','id');
    }

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class,'vendor_id','id');
    }
}
