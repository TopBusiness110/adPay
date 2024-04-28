<?php

namespace Database\Factories;

use App\Models\AppUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AppUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = AppUser::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'image' => 'uploads/users/avatar.png',
            'phone' => rand(1111111111, 9999999999),
            'type' => $this->faker->randomElement(['user', 'vendor', 'advertise']),
            'device_token' => Str::random(20),
            'password' => Hash::make('12345678'),
        ];
    }
}
