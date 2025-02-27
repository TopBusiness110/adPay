<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';


    protected $fillable = [
        'vendor_id',
        'images',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'price',
        'discount',
        'type',
        'shop_cat_id',
        'shop_sub_cat',
        'stock',
        'props',
    ];

    protected $casts = [
        'props' => 'array',
        'images' => 'array',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(AppUser::class, 'vendor_id', 'id')->where('type', 'vendor');
    }

    public function shopCategory(): BelongsTo
    {
        return $this->belongsTo(ShopCategory::class, 'shop_cat_id', 'id');
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(AppUser::class, 'vendor_id', 'id');
    }

}
