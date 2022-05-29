<?php

namespace Database\Seeders;


use App\Models\CompanyPackage;
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
             PackageSeeder::class,
         ]);

         CompanyPackage::factory(1000)->create();
    }
}
