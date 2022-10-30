<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AccountSeeder::class,
            KomponenSeeder::class,
            Masterkit::class,
            SPKSeeder::class,
            DepartemenDB_Seeder::class,
            StallSeeder::class
        ]);
        // Product::factory(50)->create();
    }
}
