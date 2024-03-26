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
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(AppUser::class)->where('type', 'user');
    }
}
