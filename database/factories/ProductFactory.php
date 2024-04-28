<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Product::class;

    public function definition()
    {
        return [
            'images'=> [
                'upload/users/avatar.png',
                'upload/users/avatar.png',
                'upload/users/avatar.png',
                'upload/users/avatar.png',
            ],
            'title_ar'=> $this->faker->name(),
            'title_en'=> $this->faker->name(),
            'description_ar'=> $this->faker->sentence(),
            'description_en'=> $this->faker->sentence(),
            'price'=> rand(700,99999),
            'discount'=> rand(0,50),
            'type'=> $this->faker->randomElement(['new','used']),
            'shop_cat_id'=> $this->faker->numberBetween(1,50),
            'shop_sub_cat'=> $this->faker->randomElement(['men','women','kids']),
            'stock'=>   $this->faker->numberBetween(222,99999),
            'props'=> [
                'color'=> $this->faker->randomElement(['red','blue','green']),
                'size'=> $this->faker->randomElement(['s','m','l']),
                'material'=> $this->faker->randomElement(['cotton','polyester']),
                'condition'=> $this->faker->randomElement(['new','used']),
                'warranty'=> $this->faker->randomElement(['yes','no']),
                'delivery'=> $this->faker->randomElement(['yes','no']),
                'free_shipping'=> $this->faker->randomElement(['yes','no']),
                'free_return'=> $this->faker->randomElement(['yes','no']),
                'free_installation'=> $this->faker->randomElement(['yes','no']),
                'free_exchange'=> $this->faker->randomElement(['yes','no']),
                'free_cancellation'=> $this->faker->randomElement(['yes','no']),
                'free_gift'=> $this->faker->randomElement(['yes','no']),
                'free_support'=> $this->faker->randomElement(['yes','no']),
            ],
        ];
    }
}
