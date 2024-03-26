<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuctionSubCategory extends Model
{
    use HasFactory;

    protected $table = 'auction_sub_categories';

    protected $fillable = [
        'title_ar',
        'title_en',
        'cat_id',
    ];

    public function auctionCategory() : BelongsTo
    {
        return $this->belongsTo(AuctionCategory::class, 'cat_id', 'id');
    }
}
