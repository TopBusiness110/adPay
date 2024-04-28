<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Address;
use App\Models\AppUser;

use App\Models\Auction;
use App\Models\Product;
use App\Models\Shop;
use App\Models\UserViewAd;
use Illuminate\Database\Seeder;

class UserViewAdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserViewAd::factory()->count(200)->create();
    }
}
