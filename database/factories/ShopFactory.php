<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Shop::class;

    public function definition()
    {
        return [
            'logo' => 'upload/users/avatar.png',
            'banner' => 'upload/users/avatar.png',
            'title_ar' => $this->faker->name(),
            'title_en' => $this->faker->name(),
            'shop_cat_id' => rand(1,50),
            'shop_sub_cat' => rand(1,50),
//            'vendor_id'=>rand(1,50),
        ];
    }
}
