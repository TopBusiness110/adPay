<?php

namespace Database\Factories;

use App\Models\ShopCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = ShopCategory::class;

    public function definition()
    {
        return [
            'title_ar' => $this->faker->name(),
            'title_en' => $this->faker->name(),
            'status' => rand(0, 1),
        ];
    }
}
