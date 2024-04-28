<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuctionCategory extends Model
{
    use HasFactory;

    protected $table = 'auction_categories';

    protected $fillable = [
        'title_ar',
        'title_en',
    ];

    public function subCategories(): HasMany
    {
        return $this->hasMany(AuctionSubCategory::class, 'cat_id', 'id');
    }
}
