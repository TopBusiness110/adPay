<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserViewAd extends Model
{
    use HasFactory;
    protected $fillable=['user_id ','ad_id'];
}
