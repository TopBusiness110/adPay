<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'point_video',
        'auction_vat_description',
        'logo',
        'about_us',
        'privacy',
        'phones',
        'whatsapp',
        'fcm_server',
    ];

    protected $casts = [
        'phones' => 'array',
    ];
}
