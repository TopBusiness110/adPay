<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'count' => rand(600,99999),
            'price' => rand(2000,99999999),
        ];
    }
}
