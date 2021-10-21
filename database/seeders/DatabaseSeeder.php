<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Database\Seeders\CategoriesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CategoriesSeeder::class);
        $this->call(AttributesSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
