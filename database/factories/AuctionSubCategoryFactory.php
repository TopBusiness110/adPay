<?php

namespace Database\Factories;

use App\Models\AuctionCategory;
use App\Models\AuctionSubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuctionSubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = AuctionSubCategory::class;

    public function definition()
    {
        return [
            'title_ar' => $this->faker->name(),
            'title_en' => $this->faker->name(),
        ];
    }
}
