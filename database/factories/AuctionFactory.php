<?php

namespace Database\Factories;

use App\Models\Auction;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuctionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Auction::class;

    public function definition()
    {
        return [
            'images' => 'uploads/users/avatar.png',
            'title_ar' => $this->faker->name(),
            'title_en' => $this->faker->name(),
            'description_ar' => $this->faker->sentence(),
            'description_en' => $this->faker->sentence(),
            'user_id' => rand(1,50),
            'video' => null,
            'cat_id' => rand(1,50),
            'sub_cat_id' => rand(1,150),
            'price' => rand(3333,99999)
        ];
    }
}
