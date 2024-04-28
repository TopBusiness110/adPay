<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\UserViewAd;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserViewAdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = UserViewAd::class;

    public function definition()
    {
        return [
            'user_id' => rand(1, 50),
            'ad_id' => rand(1, 50)
        ];
    }
}
