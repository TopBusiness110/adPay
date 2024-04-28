<?php

namespace Database\Seeders;

use App\Models\AuctionCategory;
use App\Models\AuctionSubCategory;
use Illuminate\Database\Seeder;

class AuctionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AuctionCategory::factory()->count(50)->create()->each(function ($category) {
            $category->subCategories()->createMany(
                AuctionSubCategory::factory()->count(3)->make()->toArray()
            );
        });
    }
}
