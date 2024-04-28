<?php

namespace Database\Seeders;

use App\Models\AdPackage;
use App\Models\ShopCategory;
use Database\Factories\AdPackageFactory;
use Database\Factories\ShopCategoryFactory;
use Illuminate\Database\Seeder;

class ShopCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShopCategory::factory()->count(50)->create();
    }
}
