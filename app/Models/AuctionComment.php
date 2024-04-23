<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuctionComment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function auction(): BelongsTo
    {
        return $this->belongsTo(Auction::class, 'auction_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(AppUser::class, 'user_id', 'id')->select('id', 'name', 'image','phone');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(AuctionComment::class, 'comment_id', 'id');
    }
}
