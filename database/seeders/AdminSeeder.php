<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Address;
use App\Models\AppUser;

use App\Models\Auction;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'image' => 'upload/users/avatar.png',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '01122717960',
            'password' => bcrypt('admin'),
        ]);
    }
}
