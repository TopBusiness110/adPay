<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    use HasFactory;

    protected $table = 'shop_categories';

    protected $fillable = [
        'title_ar',
        'title_en',
        'status',
    ];
}
