<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdPackageSeeder::class);
        $this->call(ShopCategorySeeder::class);
        $this->call(AuctionCategorySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
