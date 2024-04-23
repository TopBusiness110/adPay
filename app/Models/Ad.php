<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ad extends Model
{
    use HasFactory;

    protected $table = 'ads';

    protected $fillable = [
        'image',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'user_id',
        'status',
        'count_views',
        'views',
        'complete',
        'video',
        'payment_status',
        'package_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(AppUser::class)->where('type', 'user');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(AdPackage::class,'package_id','id')->select('id','count','price');
    }
}
