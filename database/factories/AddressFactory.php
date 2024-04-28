<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = \App\Models\Address::class;
    public function definition()
    {
        return [
            'region' => $this->faker->name(),
            'city' => $this->faker->name,
            'details' => $this->faker->sentence(),
            'default' =>1,
        ];
    }
}
