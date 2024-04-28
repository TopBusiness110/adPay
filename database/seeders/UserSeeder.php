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

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppUser::factory()->count(50)->create()->each(function ($user) {
            $user->addresses()->save(Address::factory()->make());
            $user->ads()->save(Ad::factory()->make());
            $user->shop()->save(Shop::factory()->make());
            $user->auctions()->save(Auction::factory()->make());
            $user->products()->saveMany(Product::factory()->count(5)->make());
        });
    }
}
