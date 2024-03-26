<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdPackage extends Model
{
    use HasFactory;

    protected $table = 'ad_packages';

    protected $fillable = [
        'title_ar',
        'title_en',
        'count',
        'price',
    ];
}
