<?php

namespace App\Models;

use App\Enums\OrderTypeEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'type',
        'reference',
        'date',
        'total',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(AppUser::class)->where('type', 'user');
    }

    protected $casts = [
        'role' => OrderTypeEnums::class
    ];
}
