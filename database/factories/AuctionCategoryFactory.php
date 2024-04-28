<?php

namespace Database\Factories;

use App\Models\AuctionCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuctionCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = AuctionCategory::class;

    public function definition()
    {
        return [
            'title_ar' => $this->faker->name(),
            'title_en' => $this->faker->name(),
        ];
    }
}
