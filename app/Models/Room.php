<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(AppUser::class,'from_user_id','id');
    }
    public function toUser(): BelongsTo
    {
        return $this->belongsTo(AppUser::class,'to_user_id','id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Chat::class,'room_id','id')->orderBy('created_at');
    }
}
