<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
        'banner',
        'title_ar',
        'title_en',
        'shop_cat_id',
        'shop_sub_cat',
        'vendor_id'
    ];

    protected $casts = [
        'shop_sub_cat' => 'json'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ShopCategory::class,'shop_cat_id','id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(AppUser::class,'vendor_id','id');
    }
}
