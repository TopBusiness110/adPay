<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AppUser extends Authenticatable implements JWTSubject
{
    use HasFactory;
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
    public function products(): HasMany
    {
        return $this->hasMany(Product::class,'vendor_id','id');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class,'user_id','id');
    }

    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class,'user_id','id');
    }
    public function auctions(): HasMany
    {
        return $this->hasMany(Auction::class,'user_id','id');
    }
}
