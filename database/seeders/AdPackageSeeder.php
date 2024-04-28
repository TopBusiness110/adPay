<?php

namespace Database\Seeders;

use App\Models\AdPackage;
use Database\Factories\AdPackageFactory;
use Illuminate\Database\Seeder;

class AdPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdPackage::factory()->count(50)->create();
    }
}
