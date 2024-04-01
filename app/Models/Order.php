<?php

namespace App\Models;

use App\Enums\OrderTypeEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'vendor_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(AppUser::class,'user_id','id');
    }
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(AppUser::class,'vendor_id','id');
    }
    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }



    protected $casts = [
        'role' => OrderTypeEnums::class
    ];

}
