<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        return $this->belongsTo(AppUser::class,'user_id','id');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(AdPackage::class,'package_id','id')->select('id','count','price');
    }

    public function scopePaymentSuccess(Builder $query): Builder
    {
        return $query->where('payment_status',1);
    }
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('complete',1);
    }
}
