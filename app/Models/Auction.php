<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auction extends Model
{
    use HasFactory;

    protected $table = 'auctions';

    protected $fillable = [
        'images',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'user_id',
        'video',
        'cat_id',
        'price',
        'is_sold',
        'sub_cat_id',
        'is_sold',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(AppUser::class)->where('type', 'user');
    }

    public function auctionCategory(): BelongsTo
    {
        return $this->belongsTo(AuctionCategory::class, 'cat_id', 'id');
    }

    public function auctionSubCategory(): BelongsTo
    {
        return $this->belongsTo(AuctionSubCategory::class, 'sub_cat_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(AuctionComment::class, 'auction_id', 'id')->where('type', 'comment');
    }
}
