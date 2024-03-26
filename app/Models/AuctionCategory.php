<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionCategory extends Model
{
    use HasFactory;

    protected $table = 'auction_categories';

    protected $fillable = [
        'title_ar',
        'title_en',
    ];
}
