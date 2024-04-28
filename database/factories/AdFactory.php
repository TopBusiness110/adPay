<?php

namespace Database\Factories;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Ad::class;

    public function definition()
    {
        return [
            'image' => 'uploads/users/avatar.png',
            'title_ar' => $this->faker->name(),
            'title_en' => $this->faker->name(),
            'user_id' => rand(1,50),
            'description_ar' => $this->faker->sentence,
            'description_en' =>$this->faker->sentence,
            'status' => $this->faker->randomElement([0, 1]),
            'count_views' => rand(666,9999),
            'views' => rand(666,9999),
            'complete' =>$this->faker->randomElement([0, 1]),
            'video' => null,
            'payment_status' => $this->faker->randomElement([0, 1]),
            'package_id' => rand(1,50),
        ];
    }
}
